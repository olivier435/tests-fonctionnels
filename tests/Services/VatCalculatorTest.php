<?php

namespace App\Tests\Services;

use App\Services\VatCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class VatCalculatorTest extends TestCase
{
    private VatCalculator $service;
    protected function setup(): void
    {
        $this->service = new VatCalculator();
    }

    #[DataProvider('vatProvider')]
    public function testCalculateVat(
        float $price,
        float $rate,
        float $expected
    ): void
    {
        // $this->assertSame(
        //     //evite de l'instancie
        //     $expected,
        //     $this->service->calculateIncludingVat($price, $rate)
        // );
        $this->assertEqualsWithDelta(
            $expected,
             $this->service->calculateIncludingVat($price, $rate)
             0.00001
        );
    }

    public static function vatProvider(): array
    {
        return [
            'Tva 20%' => [100, 0.20, 120.0],
            'Tva 10%' => [100, 0.10, 110.0],
            'Tva 5.5%' => [100, 0.055, 105.5],
            'prix zéro' => [100, 0.20, 0.0],
        ];
    }

    // {

    // Arrange
    // $calculator = new VatCalculator();

    // Act
    // $result = $calculator->calculate(100);

    // Assert
    // $this->assertEquals(120, $result);
    //     $this->assertEquals(
    //         120,
    //         $this->service->Calculate(100)
    //     );
    // }

    public function testCalculateVatForZero(float $price, float $rate, float $expected): void
    {
        $this->assertSame(
            //evite de l'instancie
            $expected,
            $this->service->calculateIncludingVat($price, $rate)
        );

        //besoin de quoi prix taux

    }
    // public function testCalculateVatForZero(): void
    // {
    //     $this->assertEquals(
    //         0,
    //         $this->service->Calculate(0)
    //     );
    // }
}
