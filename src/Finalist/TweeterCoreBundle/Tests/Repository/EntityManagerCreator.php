<?php

namespace Finalist\TweeterCoreBundle\Tests\Repository;

trait EntityManagerCreator {

    private function createEntityManager() {
        self::$kernel = static::createKernel();
        self::$kernel->boot();
        $entityManager = self::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        return $entityManager;
    }

}
