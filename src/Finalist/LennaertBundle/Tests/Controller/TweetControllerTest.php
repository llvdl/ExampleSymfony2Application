<?php

namespace Finalist\LennaertBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TweetControllerTest extends WebTestCase
{
    public function testHome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testTweetlist()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tweets/{name}');
    }

    public function testTweetadd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tweet');
    }

}
