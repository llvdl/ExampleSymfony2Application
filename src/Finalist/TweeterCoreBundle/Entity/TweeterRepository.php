<?php

namespace Finalist\TweeterCoreBundle\Entity;

interface TweeterRepository {
    
    /**
     * finds a tweeter by name
     * @param string $name name
     * @return Finalist\Tweetr\Domain\Tweeter|NULL tweeter if found, otherwise NULL
     */
    public function findByName($name);
    
    /**
     * adds a tweeter to the repository
     * @param Finalist\Tweetr\Domain\Tweeter $tweeter
     */
    public function add(Tweeter $tweeter);
    
}
