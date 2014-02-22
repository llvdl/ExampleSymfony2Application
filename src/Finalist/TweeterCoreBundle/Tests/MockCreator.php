<?php

namespace Finalist\TweeterCoreBundle\Tests;

trait MockCreator {
    
    private function createTweetRepositoryMock() {
        return $this->createMock('Finalist\TweeterCoreBundle\Entity\TweetRepository');
    }
    
    private function createTweeterRepositoryMock() {
        return $this->createMock('Finalist\TweeterCoreBundle\Entity\TweeterRepository');
    }
    
    private function createTweetMock() {
        return $this->createMock('Finalist\TweeterCoreBundle\Entity\Tweet');
    }

    private function createTweeterMock($id = null, $name = '') {
        $mock = $this->createMock('Finalist\TweeterCoreBundle\Entity\Tweeter');
        $mock->expects($this->any())->method('getId')->with()->will($this->returnValue($id));
        $mock->expects($this->any())->method('getName')->with()->will($this->returnValue($name));
        return $mock;
    }

    private function createMock($className) {
        return $this->getMock($className, [], [], '', false);
    }
}
