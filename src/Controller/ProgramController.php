<?php


namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CommentType;
use App\Form\ProgramType;
use App\Form\SearchProgramFormType;
use App\Repository\ProgramRepository;
use App\Service\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


/**
 * @Route("/programs", name="program_")
 */
class ProgramController extends AbstractController
{

    /**
     * @Route("/index", name="indexAdmin")
     */
    public function indexAdmin(ProgramRepository $programRepository)
    {
        return $this->render('program/indexAdmin.html.twig',
            [
                'programs' => $programRepository->findAll(),
            ]);
    }

    /**
     * Show all row from Program's Entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(Request $request, ProgramRepository $programRepository): Response
    {
        $form = $this->createForm(SearchProgramFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search =  $form->getData()['search'];
            $programs = $programRepository->findLikeName($search);
        } else {
            $programs = $programRepository->findAll();
        }

        return $this->render('program/index.html.twig',
            [
                'programs' => $programs,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * The controller for the category add form
     *
     * @Route("/new", name="new")
     * @param Request $request
     * @param Slugify $slugify
     * @param MailerInterface $mailer
     * @return Response
     */
    public function new(Request $request, Slugify $slugify, MailerInterface $mailer) : Response
    {
        // Create a new Category Object
        $program = new Program();
        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            // Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            // Set owner of the program
            $program->setOwner($this->getUser());
            // Slugify the URL
            $slug = $slugify->generate($program->getTitle());
            $program->setSlug($slug);
            // Persist Category Object
            $entityManager->persist($program);
            // Flush the persisted object
            $entityManager->flush();
            // Add flash message
            $this->addFlash('success', 'The new program '. $program->getTitle() .' has been created');
            // Send email when new program is created
            $email = ( new Email())
                ->from($this->getParameter('mailer_from'))
                ->to('a2ebbed13a-2232dc@inbox.mailtrap.io')
                ->subject('Une nouvelle série vient de sortir !')
                ->html($this->renderView('program/newProgramEmail.html.twig', [ 'program' => $program]));
            $mailer->send($email);
            // Finally redirect to categories list
            return $this->redirectToRoute('program_show', ['slug' => $program->getSlug()]);
        }
        // Render the form
        return $this->render('program/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{slug}", name="show")
     * @param Program $program
     * @return Response
     */
    public function show(Program $program): Response
    {
        $seasons = $program->getSeasons();

        if(!$program) {
            return $this->render('error.html.twig');
        }
        return $this->render('program/show.html.twig',
            ['program' => $program,
                'seasons' => $seasons
            ]);
    }

    /**
     * @Route ("/{slug}/seasons/{season}", name="season_show")
     * @param Program $program
     * @param Season $season
     * @return Response
     */
    public function showSeason(Program $program, Season $season): Response
    {
        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['program' => $program, 'number' => $season]);

        $episodes = $this->getDoctrine()
            ->getRepository(Episode::class)
            ->findBy(['season' => $season]);

        return $this->render('program/season_show.html.twig',
        ['program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);
    }

    /**
     * @Route("/{programSlug}/seasons/{season}/episode/{episodeSlug}", name="episode_show")
     * @ParamConverter ("program", class="App\Entity\Program", options={"mapping": {"programSlug": "slug"}})
     * @ParamConverter ("episode", class="App\Entity\Episode", options={"mapping": {"episodeSlug": "slug"}})
     * @param Program $program
     * @param Season $season
     * @param Episode $episode
     * @param Request $request
     * @return Response
     */
    public function showEpisode(Program $program, Season $season, Episode $episode, Request $request): Response
    {
        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['program' => $program, 'number' => $season]);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $comment->setEpisode($episode);
            $comment->setAuthor($user);
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('program_episode_show',
            [
                'programSlug' => $program->getSlug(),
                'season' => $season->getNumber(),
                'episodeSlug' => $episode->getSlug(),
            ]);
        }

        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(['episode' => $episode], ['id' => 'ASC'], 6);

        return $this->render('program/episode_show.html.twig',
            ['program' => $program,
                'season' => $seasons,
                'episode' => $episode,
                'form' => $form->createView(),
                'comments' => $comments
            ]);
    }

    /**
     * @Route("/{slug}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Program $program
     * @return Response
     */
    public function edit(Request $request, Program $program): Response
    {
        // Check wether the logged in user is the owner of the program
        if (!($this->getUser() == $program->getOwner())) {
            // If not the owner, throws a 403 Access Denied exception
        throw new AccessDeniedException('Only the owner can edit the program!');
        }

        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'The new program '. $program->getTitle() .' has been created');

            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/edit.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{program}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Program $program): Response
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($program);
            $entityManager->flush();
            $this->addFlash('danger', 'The program '. $program->getTitle() .' has been deleted');
        }

        return $this->redirectToRoute('program_index');
    }

    /**
     * @Route ("/{id}/watchlist", name="watchlist")
     * @param Request $request
     * @param Program $program
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function addToWatchlist(Request $Request, Program $program, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->getWatchlist()->contains($program)) {
            $this->getUser()->removeWatchlist($program);
        }
        else {
            $this->getUser()->addWatchlist($program);
        }

        $entityManager->flush();

        return $this->json([
            'isInWatchlist' => $this->getUser()->isInWatchlist($program)
        ]);
    }
}
