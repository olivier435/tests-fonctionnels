<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginPageIsAccessible(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Connexion');
        $this->assertSelectorExists('input[name="_username"]');
        $this->assertSelectorExists('input[name="_password"]');
    }

    public function testUserCanLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $client->submitForm('Se connecter', [
            '_username' => 'user@test.fr',
            '_password' => 'Password123!',
        ]);

        $this->assertSelectorNotExists('.csrf-error');
        $this->assertResponseRedirects('/dashboard');
    }

    public function testBadCredentialsAreRejected(): void
    {
        $client = static::createClient();
        $badCredentials = [
            ['user0@gmail.com', 'Password123!'],
            ['user@test.fr', '123'],
        ];

        foreach ($badCredentials as [$email, $password]) {
            $client->request('GET', '/login');

            $client->submitForm('Se connecter', [
                '_username' => $email,
                '_password' => $password,
            ]);

            $this->assertResponseRedirects('/login');

            $client->followRedirect();

            $this->assertSelectorExists('.alert-danger');
            $this->assertAnySelectorTextContains('body', 'Invalid credentials.');
        }
    }

    public function testUserCanAccessDashboardWhenLoggedIn(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneBy([
            'email' => 'user@test.fr',
        ]);

        $client->loginUser($user);

        $client->request('GET', '/dashboard');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Dashboard');
    }

    public function testAnonymousUserCannotAccessDashboard(): void
    {
        $client = static::createClient();

        $client->request('GET', '/dashboard');

        $this->assertResponseRedirects('/login');
    }
}
