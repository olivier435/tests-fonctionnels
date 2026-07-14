<?php

namespace App\Services;

use InvalidArgumentException;

class RegistrationService
{
    public function register(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                'Adresse email invalide.'
            );
        }
    }
}
