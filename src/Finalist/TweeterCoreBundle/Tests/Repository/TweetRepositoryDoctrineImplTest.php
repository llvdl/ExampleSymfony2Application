<?php

namespace Finalist\TweeterCoreBundle\Tests\Repository;

use Finalist\TweeterCoreBundle\Repository\TweetRepositoryDoctrineImpl;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class TweetRepositoryDoctrineImplTest extends WebTestCase {

    use \Finalist\TweeterCoreBundle\Tests\MockCreator;
    
    /** @var \Doctrine\ORM\EntityManager */
    private $entityManager;
    
    /** @var TweetRepositoryDoctrineImpl */
    private $subject;
    
    public function setUp() {
        self::$kernel = static::createKernel();
        self::$kernel->boot();
        $this->entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;

        $client = static::createClient();
        $this->loadFixtures([
            '\Finalist\TweeterCoreBundle\Tests\DataFixtures\Orm\LoadTweetData',
            '\Finalist\TweeterCoreBundle\Tests\DataFixtures\Orm\LoadTweeterData',
        ]);

        $this->subject = new TweetRepositoryDoctrineImpl($this->entityManager);
    }
    
    public function testFindByTweeterNoTweets() {
        $tweeterNoTweets = $this->loadTweeterByName('tweeter no tweets');
//        $this->assertSame([], $this->subject->FindByTweeter($tweeterNoTweets));
    }

    public function xtestFindByTweeterOneTweet() {
        $client = static::createClient();
        $this->loadFixtures([]);
        
        $tweeterOneTweet = $this->loadTweeterByName('tweeter one tweet');
        $tweets = $this->subject->FindByTweeter($tweeterOneTweet);
        $this->assertCount(1, $tweets);
    }

    
    private function loadTweeterByName($name) {
        $repository = $this->entityManager->getRepository('Finalist\TweeterCoreBundle\Entity\Tweeter');
        $tweeter = $repository->findOneBy(['name'=>$name]);
        if($tweeter === null) {
            throw new \Exception('could not find tweeter with name "'.$name.'"');
        }
        return $tweeter;
    }
    
}
