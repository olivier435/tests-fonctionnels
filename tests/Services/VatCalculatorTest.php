<?php

namespace App\Tests\Services;

use App\Services\VatCalculator;
use PHPUnit\Framework\TestCase;

class VatCalculatorTest extends TestCase
{
    private VatCalculator $service;
    protected function setup(): void
    {
        $this->service = new VatCalculator();
    }
    public function testCalculateVat(): void
    {
        // Arrange
        // $calculator = new VatCalculator();

        // Act
        // $result = $calculator->calculate(100);

        // Assert
        // $this->assertEquals(120, $result);
        $this->assertEquals(
            120,
            $this->service->Calculate(100)
        );
    }
    public function testCalculateVatForZero(): void
    {
        $this->assertEquals(
            0,
            $this->service->Calculate(0)
        );
    }
}
