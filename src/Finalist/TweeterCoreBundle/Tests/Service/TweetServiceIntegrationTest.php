<?php

namespace Finalist\TweeterCoreBundle\Tests\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class TweetServiceIntegrationTest extends WebTestCase {

    use \Finalist\TweeterCoreBundle\Tests\KernelBooter;

    public function setUp() {
        $this->bootKernel();
    }

    public function testGetService() {
        $service = self::$kernel->getContainer()->get('finalist_tweeter_core.tweet_service');
        $this->assertNotNull($service);
    }

}
