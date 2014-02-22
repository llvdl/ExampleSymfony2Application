<?php

namespace Finalist\TweeterCoreBundle\Entity;

interface TweetRepository {
    
    /**
     * find the $maxAmount most recent tweets
     * @param int $maxAmount maximum amount of tweets in the result set
     * @return Finalist\Tweetr\Domain\Tweet[] list of tweeters, sorted by most recent first
     */
    public function findMostRecent($maxAmount);
    
    /**
     * finds all tweets made by a specific tweeter
     * @param Finalist\Tweetr\Domain\Tweeter $tweeter
     * @return Finalist\Tweetr\Domain\Tweet[] list of tweeters, sorted by most recent first
     */
    public function FindByTweeter(Tweeter $tweeter);
    
    
    /**
     * adds a tweet to the repository
     * @param Finalist\Tweetr\Domain\Tweet $tweet
     */
    public function add(Tweet $tweet);
}
