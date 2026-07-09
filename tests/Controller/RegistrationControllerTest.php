<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegisterPageIsAccessible(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Inscription');
        $this->assertSelectorExists('input[name="registration_form[email]"]');
        $this->assertSelectorExists('input[name="registration_form[plainPassword]"]');
    }

    public function testUserCanRegister(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $email = sprintf('john-$s@test.fr', bin2hex(random_bytes(6)));

        // $client->submitForm('Créer un compte', [
        //     'registration_form[email]' => 'john@test.fr',
        //     'registration_form[plainPassword]' => 'Password1234',
        // ]);
        $client->submitForm('Créer un compte', [
            'registration_form[email]' => $email,
            'registration_form[plainPassword]' => 'Password1234!',
        ]);

        $this->assertResponseRedirects('/login');

        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneBy([
            'email' => '$email',
        ]);

        $this->assertNotNull($user);
    }

    public function testUserCannotRegisterWithInvalidEmail(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $client->submitForm('Créer un compte', [
            'registration_form[email]' => 'toto',
            'registration_form[plainPassword]' => 'Password1234!',
        ]);

        $this->assertResponseStatusCodeSame(422);
        $this->assertSelectorTextContains('body', 'adresse email valide');
    }

    public function testUserCannotRegisterWithShortPassword(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $client->submitForm('Créer un compte', [
            'registration_form[email]' => 'short@test.Fr',
            'registration_form[plainPassword]' => '123',
        ]);

        $this->assertResponseStatusCodeSame(422);
        $this->assertSelectorTextContains('body', '12 caractères');
    }
}
