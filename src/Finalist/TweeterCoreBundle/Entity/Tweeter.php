<?php

namespace Finalist\TweeterCoreBundle\Entity;

use Finalist\TweeterCoreBundle\Entity\Id;

class Tweeter {

    /** @var Id */
    private $id;
    /** @var string */
    private $name;
    
    public function __construct($name) {
        $this->id = null;
        $this->name = $name;
    }
    
    /** @return Id */
    public function getId() {
        return $this->id;
    }

    /** @return string */
    public function getName() {
        return $this->name;
    }
}
