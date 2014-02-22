<?php

namespace Finalist\TweeterCoreBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use Finalist\TweeterCoreBundle\Entity\TweetService;

class TweetServiceTest extends TestCase {

    use \Finalist\TweeterCoreBundle\Tests\MockCreator;
    
    /** @var Finalist\TweeterCoreBundle\Entity\TweetService */
    private $subject;
    
    private $tweetRepositoryMock;
    private $tweeterRepositoryMock;
    
    public function setUp() {
        $this->tweetRepositoryMock = $this->createTweetRepositoryMock();
        $this->tweeterRepositoryMock = $this->createTweeterRepositoryMock();
        
        $this->subject = new TweetService($this->tweetRepositoryMock, $this->tweeterRepositoryMock);
    }
    
    public function testGetRecentTweets() {
        $tweetMocks = [
            $this->createTweetMock(),
            $this->createTweetMock()
        ];
        
        $this->tweetRepositoryMock->expects($this->once())
                ->method('findMostRecent')
                ->with($this->isType('int'))
                ->will($this->returnValue($tweetMocks));
        
        $this->assertSame($tweetMocks, $this->subject->getRecentTweets());
    }
    
    /** @expectedException \Finalist\TweeterCoreBundle\Entity\DomainException */
    public function testGetRecentTweetsForTweeterNotFoundThrowsException() {
        $this->tweeterRepositoryMock->expects($this->once())
                ->method('findByName')
                ->with($this->identicalTo('timmy tweeter'))
                ->will($this->returnValue(null));
        
        $this->subject->getRecentTweetsForTweeter('timmy tweeter');
    }

    public function testGetRecentTweetsForTweeter() {
        $tweeterMock = $this->createTweeterMock();
        
        $tweetMocks = [
            $this->createTweetMock(),
            $this->createTweetMock()
        ];

        $this->tweeterRepositoryMock->expects($this->once())
                ->method('findByName')
                ->with($this->identicalTo('timmy tweeter'))
                ->will($this->returnValue($tweeterMock));
        
        $this->tweetRepositoryMock->expects($this->once())
                ->method('findByTweeter')
                ->with($this->identicalTo($tweeterMock))
                ->will($this->returnValue($tweetMocks));
        
        $this->assertSame($tweetMocks, $this->subject->getRecentTweetsForTweeter('timmy tweeter'));
    }
    
    public function testCreateTweetForNewTweeter() {
        $this->tweeterRepositoryMock->expects($this->once())
                ->method('findByName')
                ->with($this->identicalTo('timmy tweeter'))
                ->will($this->returnValue(null));
        
        $this->tweetRepositoryMock->expects($this->once())
                ->method('add')
                ->with($this->isiNstanceOf('Finalist\TweeterCoreBundle\Entity\Tweet'));

        $this->tweeterRepositoryMock->expects($this->once())
                ->method('add')
                ->with($this->isInstanceOf('\Finalist\TweeterCoreBundle\Entity\Tweeter'));
        
        $tweet = $this->subject->createTweet('timmy tweeter', 'my first tweet');
        $this->assertInstanceOf('Finalist\TweeterCoreBundle\Entity\Tweet', $tweet);
        $this->assertSame('timmy tweeter', $tweet->getTweeter()->getName());
        $this->assertSame('my first tweet', $tweet->getText());
        $this->assertGreaterThan(time() - 2, $tweet->getTimestamp());
        $this->assertLessThanOrEqual(time(), $tweet->getTimestamp());
    }
}
