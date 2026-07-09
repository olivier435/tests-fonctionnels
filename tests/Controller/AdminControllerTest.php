<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testAnonymousUserCannotAccessAdmin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin');

        $this->assertResponseRedirects('/login');
    }

    public function testSimpleUserCannotAccessAdmin(): void
    {
        $client = static::createClient();
        //recuperer mon user
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneBy([
            'email' => 'user@test.Fr',
        ]);
        $client->loginUser($user);
        $client->request('GET', '/admin');
        $this->assertResponseStatusCodeSame(403);
    }

    public function testAdminCanAccessAdminPage(): void
    {
        $client = static::createClient();
        //recuperer mon user
        $userRepository = static::getContainer()->get(UserRepository::class);
        $admin = $userRepository->findOneBy([
            'email' => 'admin@test.Fr',
        ]);
        $client->loginUser($admin);

        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Administration');
    }
}
