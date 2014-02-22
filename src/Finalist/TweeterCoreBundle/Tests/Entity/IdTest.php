<?php

namespace Finalist\TweeterCoreBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Finalist\TweeterCoreBundle\Entity\Id;

class IdTest extends TestCase {

    /** @expectedException \Finalist\TweeterCoreBundle\Entity\DomainException */
    public function testValueMayNotBeEmpty() {
        $id = new Id('');
    }

    /** @expectedException \Finalist\TweeterCoreBundle\Entity\DomainException */
    public function testValueMayNotBeNull() {
        $id = new Id(null);
    }

    /** @expectedException \Finalist\TweeterCoreBundle\Entity\DomainException */
    public function testValueMayNotBeZero() {
        $id = new Id(0);
    }
    
    /** @expectedException \Finalist\TweeterCoreBundle\Entity\DomainException */
    public function testRoundedValueMayNotBeZero() {
        $id = new Id(.4);
    }

    /** @expectedException \Finalist\TweeterCoreBundle\Entity\DomainException */
    public function testValueMayNotBeNegative() {
        $id = new Id(-1);
    }
    
    public function testValueIsValidString() {
        $id = new Id('123');
        $this->assertInstanceOf('Finalist\TweeterCoreBundle\Entity\Id', $id);
    }

    public function testValueIsValidNumber() {
        $id = new Id(123);
        $this->assertInstanceOf('Finalist\TweeterCoreBundle\Entity\Id', $id);
    }
    
    public function testValueIsConvertedToNumber() {
        $id = new Id('123');
        $this->assertSame(123, $id->getValue());
    }

}
