<?php

namespace Finalist\TweeterCoreBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use Finalist\TweeterCoreBundle\Entity\Tweeter;

class TweeterTest extends TestCase {

    use \Finalist\TweeterCoreBundle\Tests\MockCreator;
    
    private $subject;
    
    public function setUp() {
        $this->subject = new Tweeter('my name');
    }
    
    public function testGetters() {
        $this->assertSame(null, $this->subject->getId());
        $this->assertSame('my name', $this->subject->getName());
    }
    
    public function testGetIdReturnsPrivateIdProperty() {
        $idMock = $this->createIdMock();
        
        $reflector = new \ReflectionProperty(get_class($this->subject), 'id');
        $reflector->setAccessible(true);
        $reflector->setValue($this->subject, $idMock);
        
        $this->assertSame($idMock, $this->subject->getId());
    }
    
}
