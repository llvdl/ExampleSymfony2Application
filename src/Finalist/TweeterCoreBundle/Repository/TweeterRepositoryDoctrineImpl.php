<?php

use Finalist\TweeterCoreBundle\Entity\TweeterRepository;
use Finalist\TweeterCoreBundle\Entity\Tweeter;
use Doctrine\ORM\EntityManager;

class TweeterRepositoryDoctrineImpl implements TweeterRepository {
    
    /** @var EntityManager */
    private $entityManager;
    
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    public function add(Tweeter $tweeter) {
        $this->entityManager->persist($tweeter);
        $this->entityManager->flush();
    }

    public function findByName($name) {
        $repository = $this->entityManager->getRepository('Finalist\TweeterCoreBundle\Entity\Tweeter');
        return $repository->findOneName($name);
    }

}
