<?php

namespace App\Services;

class VatCalculator
{
    public function calculate(float $price): float
    {
        return $price * 1.20;
    }
}
