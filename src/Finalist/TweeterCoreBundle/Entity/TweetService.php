<?php

namespace Finalist\TweeterCoreBundle\Entity;

class TweetService {

    /** @var \Finalist\TweeterCoreBundle\Entity\TweetRepository */
    private $tweetRepository;
    /** @var \Finalist\TweeterCoreBundle\Entity\TweeterRepository */
    private $tweeterRepository;
    
    public function __construct(TweetRepository $tweetRepository, TweeterRepository $tweeterRepository) {
        $this->tweetRepository = $tweetRepository;
        $this->tweeterRepository = $tweeterRepository;
    }
    
    /** @return \Finalist\TweeterCoreBundle\Entity\Tweet[] */
    public function getRecentTweets() {
        return $this->tweetRepository->findMostRecent(10);
    }
    
    /** 
     * @param string $name
     * @return Tweet[]
     * @throws DomainException if tweeter is not found
     */
    public function getRecentTweetsForTweeter($name) {
        $tweeter = $this->getTweeterByName($name);
        if($tweeter === null) {
            throw new DomainException('Tweeter not found');
        }
        return $this->tweetRepository->findByTweeter($tweeter);
    }
    
    /**
     * @param string $name tweeter name
     * @param string $text
     * @return Tweet
     */
    public function createTweet($name, $text) {
        $timestamp = time();
        
        $tweeter = $this->getTweeterByName($name);
        if($tweeter === null) {
            $tweeter = $this->createTweeter($name);
        }
        
        $tweet = new Tweet($tweeter, $text, $timestamp);
        $this->tweetRepository->add($tweet);
        return $tweet;
    }
    
    /** @return Tweeter|NULL */
    private function getTweeterByName($name) {
        $tweeter = $this->tweeterRepository->findByName($name);
        return $tweeter;
    }
    
    /** @return Tweeter */
    private function createTweeter($name) {
        $tweeter = new Tweeter($name);
        $this->tweeterRepository->add($tweeter);
        return $tweeter;
    }
}
