<?php

namespace Finalist\TweeterCoreBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use Finalist\TweeterCoreBundle\Entity\Tweet;

class TweetTest extends TestCase {

    use \Finalist\TweeterCoreBundle\Tests\MockCreator;
    
    /** @var \Finalist\TweeterCoreBundle\Entity\Tweet */
    private $subject;
    
    private $tweeterMock;
    
    public function setUp() {
        $this->tweeterMock = $this->createTweeterMock();
        $text = 'hello, my tweet';
        $timestamp = 123456;
        $this->subject = new Tweet($this->tweeterMock, $text, $timestamp);
    }
    
    public function testGetters() {
        $this->assertSame(null, $this->subject->getId());
        $this->assertSame($this->tweeterMock, $this->subject->getTweeter());
        $this->assertSame('hello, my tweet', $this->subject->getText());
        $this->assertSame(123456, $this->subject->getTimestamp());
    }
    
    public function testGetIdReturnsPrivateIdProperty() {
        $idMock = $this->createIdMock();
        
        $reflector = new \ReflectionProperty(get_class($this->subject), 'id');
        $reflector->setAccessible(true);
        $reflector->setValue($this->subject, $idMock);
        
        $this->assertSame($idMock, $this->subject->getId());
    }
}
