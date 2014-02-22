<?php

namespace Finalist\TweeterCoreBundle\Repository;

use Finalist\TweeterCoreBundle\Entity\TweeterRepository;
use Finalist\TweeterCoreBundle\Entity\Tweeter;
use Doctrine\ORM\EntityManager;
use Finalist\TweeterCoreBundle\Entity\DomainException;

class TweeterRepositoryDoctrineImpl implements TweeterRepository {
    
    /** @var EntityManager */
    private $entityManager;
    
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    public function add(Tweeter $tweeter) {
        if($this->findByName($tweeter->getName()) !== null) {
            throw new DomainException('Tweeter with name "'.$tweeter->getName().'" already exists.');
        }
        
        $this->entityManager->persist($tweeter);
        $this->entityManager->flush();
    }

    /** @return Finalist\TweeterCoreBundle\Entity\Tweeter|NULL tweeter instance or NULL if not found */
    public function findByName($name) {
        $repository = $this->entityManager->getRepository('Finalist\TweeterCoreBundle\Entity\Tweeter');
        return $repository->findOneByName($name);
    }

}
