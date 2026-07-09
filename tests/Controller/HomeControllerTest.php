<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomepageIsSuccessfull(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('h1');
        self::assertSelectorTextContains('h1', 'Bienvenue');
    }
    public function testUnknownPageReturns404(): void
    {
        $client = static::createClient();
        $craxler = $client->request('GET', "/page-inexistante");

        self::assertResponseStatusCodeSame(404);
    }
}
