<?php

namespace Finalist\TweeterCoreBundle\Tests\Repository;

trait EntityManagerCreator {

    use \Finalist\TweeterCoreBundle\Tests\KernelBooter;
    
    private function getEntityManager() {
        $this->bootKernel();
        $entityManager = self::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        return $entityManager;
    }

}
