<?php

namespace Finalist\TweeterCoreBundle\Repository\Impl;

use Finalist\TweeterCoreBundle\Repository\TweetRepository;
use Doctrine\ORM\EntityManager;
use Finalist\TweeterCoreBundle\Entity\Tweeter;
use Finalist\TweeterCoreBundle\Entity\Tweet;

class TweetRepositoryDoctrineImpl implements TweetRepository {

    /** @var \Doctrine\ORM\EntityManager */
    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /** @return \Finalist\TweeterCoreBundle\Entity\Tweet[] */
    public function FindByTweeter(Tweeter $tweeter) {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('tweet, tweeter')
                ->from('Finalist\TweeterCoreBundle\Entity\Tweet', 'tweet')
                ->leftJoin('tweet.tweeter', 'tweeter')
                ->where('tweeter.id = :tweeter_id')
                ->orderBy('tweet.timestamp', 'DESC')
                ->setParameter('tweeter_id', $tweeter->getId());
        
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    public function add(Tweet $tweet) {
        $this->entityManager->persist($tweet);
        $this->entityManager->flush();
    }

    /** @return \Finalist\TweeterCoreBundle\Entity\Tweet[] */
    public function findMostRecent($maxAmount) {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder->select('tweet, tweeter')
                ->from('Finalist\TweeterCoreBundle\Entity\Tweet', 'tweet')
                ->leftJoin('tweet.tweeter', 'tweeter')
                ->orderBy('tweet.timestamp', 'DESC')
                ->setMaxResults($maxAmount);
        
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }
    
    /** @return Doctrine\ORM\QueryBuilder */
    private function createQueryBuilder() {
        return $this->entityManager->createQueryBuilder();
    }

}
