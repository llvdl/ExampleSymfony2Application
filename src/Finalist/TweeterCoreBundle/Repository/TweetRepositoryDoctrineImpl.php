<?php

namespace Finalist\TweeterCoreBundle\Repository;

use Finalist\TweeterCoreBundle\Entity\TweetRepository;
use Doctrine\ORM\EntityManager;
use Finalist\TweeterCoreBundle\Entity\Tweeter;
use Finalist\TweeterCoreBundle\Entity\Tweet;

class TweetRepositoryDoctrineImpl implements TweetRepository {

    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function FindByTweeter(Tweeter $tweeter) {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('tweet, tweeter')
                ->from('Finalist\TweeterCoreBundle\Entity\Tweet', 'tweet')
                ->leftJoin('tweet.tweeter', 'tweeter')
                ->where('tweeter.id = :tweeter_id')
                ->orderBy('tweet.timestamp', 'DESC')
                ->setParameter('tweeter_id', $tweeter->getId()->getValue());
        
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    public function add(Tweet $tweet) {
        $this->entityManager->persist($tweet);
        $this->entityManager->flush();
    }

    public function findMostRecent($maxAmount) {
        $dql = 'SELECT tweet, tweeter'
                . ' FROM Tweet tweet'
                . ' LEFT JOIN tweet.tweeter tweeter'
                . ' ORDER BY tweet.timestamp DESC';
        $query = $this->entityManager->createQuery($dql)->setMaxResults($maxAmount);
        return $query->getResult();
    }

}
