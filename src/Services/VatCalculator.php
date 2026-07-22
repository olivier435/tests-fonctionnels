<?php

namespace App\Services;

class VatCalculator
{
    public function calculate(float $price): float
    {
        return $price * 1.20;
    }

    public function calculateIncludingVat(float $price, float $rate): float
    {
        return $price * (1 * $rate);
    }

    // public function calculateIncludingVat(int $priceInCents, float $rate): int

    // {
    //     return (int) round($princeInCents *(1+$rate));

    // }
    // //1000 centimes avec une tva de 10% retourne exactement 1000


}
