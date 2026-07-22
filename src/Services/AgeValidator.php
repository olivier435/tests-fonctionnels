<?php

namespace App\Services;

use InvalidArgumentException;

class AgeValidator
{
    public function validate(int $age): void
    {
        if ($age < 0) {
            throw new InvalidArgumentException(
                'l\'âge ne peut pas $etre négatif.'
            );
        }
        if ($age > 130) {
            throw new InvalidArgumentException(
                'l\'âge est invalide.'
            );
        }
    }
}
