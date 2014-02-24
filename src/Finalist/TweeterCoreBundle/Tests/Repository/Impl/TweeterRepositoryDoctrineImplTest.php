<?php

namespace Finalist\TweeterCoreBundle\Tests\Repository\Impl;

use Finalist\TweeterCoreBundle\Repository\Impl\TweeterRepositoryDoctrineImpl;
use Liip\FunctionalTestBundle\Test\WebTestCase;

use Finalist\TweeterCoreBundle\Entity\Tweeter;

class TweeterRepositoryDoctrineImplTest extends WebTestCase {

    use \Finalist\TweeterCoreBundle\Tests\Repository\EntityManagerCreator;
    
    /** @var \Doctrine\ORM\EntityManager */
    private $entityManager;

    /** @var \Finalist\TweeterCoreBundle\Repository\Impl\TweeterRepositoryDoctrineImpl */
    private $subject;
    
    public function setUp() {
        $this->entityManager = $this->getEntityManager();
                $client = static::createClient();
        $this->loadFixtures([
            '\Finalist\TweeterCoreBundle\Tests\DataFixtures\Orm\LoadTweetData',
            '\Finalist\TweeterCoreBundle\Tests\DataFixtures\Orm\LoadTweeterData',
        ]);

        $this->subject = new TweeterRepositoryDoctrineImpl($this->entityManager);
    }
    
    public function testImplementsInterface() {
        $this->assertInstanceOf('Finalist\TweeterCoreBundle\Repository\TweeterRepository', $this->subject);
    }

    
    public function testAdd() {
        $this->assertNull($this->loadTweeterByName('a new name'), 'tweeter with name "a new name" does not exist yet');
        
        $tweeter = new Tweeter('a new name');
        $this->assertNull($tweeter->getId());
        $this->subject->add($tweeter);
        $this->assertNotNull($tweeter->getId());
        
        $loadedTweeter = $this->loadTweeterByName('a new name');
        $this->assertNotNull($loadedTweeter, 'tweeter can be found in database');
        $this->assertSame($tweeter->getId(), $loadedTweeter->getId());
    }
    
    /** @expectedException \Finalist\TweeterCoreBundle\Exception\DomainException */
    public function testAddExistingThrowsDomainException() {
        $this->assertNotNull($this->loadTweeterByName('tweeter one tweet'));
        
        $tweeter = new Tweeter('tweeter one tweet');
        $this->subject->add($tweeter);
        $this->fail('expected DomainException to be thrown');
    }
    
    public function testFindByNameExists() {
        $tweeter = $this->subject->findByName('tweeter one tweet');
        $this->assertNotNull($tweeter);
        $this->assertSame('tweeter one tweet', $tweeter->getName());
    }

    public function testFindByNameNotExistsReturnsNull() {
        $tweeter = $this->subject->findByName('tweeter with this name does not exist');
        $this->assertNull($tweeter);
    }
    
    private function loadTweeterByName($name) {
        $repository = $this->entityManager->getRepository('Finalist\TweeterCoreBundle\Entity\Tweeter');
        return $repository->findOneByName($name);
    }
}
