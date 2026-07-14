<?php

namespace App\Services;

use InvalidArgumentException;

class Calculator
{
    public function add(int $a, int $b): int
    {
        return $a + $b;
    }

    public function substract(int $a, int $b): int
    {
        return $a - $b;
    }

    public function divide(int $a, int $b): float
    {
        if ($b === 0) {
            throw new InvalidArgumentException(
                'Division par zéro interdite.',
                1001
            );
        }

        return $a / $b;
    }
}
