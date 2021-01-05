<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Program extends \App\Entity\Program implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'title', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'summary', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'poster', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'category', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'seasons', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'actors', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'slug', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'owner'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'title', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'summary', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'poster', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'category', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'seasons', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'actors', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'slug', '' . "\0" . 'App\\Entity\\Program' . "\0" . 'owner'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Program $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getTitle(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', []);

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle(string $title): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', [$title]);

        return parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getSummary(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSummary', []);

        return parent::getSummary();
    }

    /**
     * {@inheritDoc}
     */
    public function setSummary(string $summary): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSummary', [$summary]);

        return parent::setSummary($summary);
    }

    /**
     * {@inheritDoc}
     */
    public function getPoster(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPoster', []);

        return parent::getPoster();
    }

    /**
     * {@inheritDoc}
     */
    public function setPoster(?string $poster): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPoster', [$poster]);

        return parent::setPoster($poster);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory(): ?\App\Entity\Category
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategory', []);

        return parent::getCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory(?\App\Entity\Category $category): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategory', [$category]);

        return parent::setCategory($category);
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getSeasons(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSeasons', []);

        return parent::getSeasons();
    }

    /**
     * {@inheritDoc}
     */
    public function addSeason(\App\Entity\Season $season): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSeason', [$season]);

        return parent::addSeason($season);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSeason(\App\Entity\Season $season): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeSeason', [$season]);

        return parent::removeSeason($season);
    }

    /**
     * {@inheritDoc}
     */
    public function getActors(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getActors', []);

        return parent::getActors();
    }

    /**
     * {@inheritDoc}
     */
    public function addActor(\App\Entity\Actor $actor): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addActor', [$actor]);

        return parent::addActor($actor);
    }

    /**
     * {@inheritDoc}
     */
    public function removeActor(\App\Entity\Actor $actor): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeActor', [$actor]);

        return parent::removeActor($actor);
    }

    /**
     * {@inheritDoc}
     */
    public function getSlug(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSlug', []);

        return parent::getSlug();
    }

    /**
     * {@inheritDoc}
     */
    public function setSlug(string $slug): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSlug', [$slug]);

        return parent::setSlug($slug);
    }

    /**
     * {@inheritDoc}
     */
    public function getOwner(): ?\App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOwner', []);

        return parent::getOwner();
    }

    /**
     * {@inheritDoc}
     */
    public function setOwner(?\App\Entity\User $owner): \App\Entity\Program
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOwner', [$owner]);

        return parent::setOwner($owner);
    }

}
