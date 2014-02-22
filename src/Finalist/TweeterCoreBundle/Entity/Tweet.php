<?php

namespace Finalist\TweeterCoreBundle\Entity;

class Tweet {
    
    /** @var Finalist\Tweetr\Domain\Id */
    private $id;
    /** @var Finalist\Tweetr\Domain\Tweeter */
    private $tweeter;
    /** @var string */
    private $text;
    /** @var int */
    private $timestamp;
    
    public function __construct(Tweeter $tweeter, $text, $timestamp) {
        $this->id = null;
        $this->tweeter = $tweeter;
        $this->text = $text;
        $this->timestamp = $timestamp;
    }
    
    /** @return Id */
    public function getId() {
        return $this->id;
    }
    
    /** @return string */
    public function getText() {
        return $this->text;
    }
    
    /** @return Tweeter */
    public function getTweeter() {
        return $this->tweeter;
    }
    
    /** @return int */
    public function getTimestamp() {
        return $this->timestamp;
    }
}
