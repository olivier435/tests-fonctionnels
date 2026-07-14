<?php

namespace App\Tests\Services;

use App\Services\Calculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        //j instencie cet objet calculator
        $this->calculator = new Calculator();
    }
    public function testAddition(): void
    {
        // Arrange
        // $calculator = new Calculator();

        // Act
        $result =  $this->calculator->add(2, 3);

        // Assert
        $this->assertEquals(5, $result);
    }

    public function testSubstract(): void
    {
        $calculator = new Calculator();
        $this->assertEquals(
            1,
            $this->calculator->substract(3, 2)
        );
    }

    public function testDivisionByZero(): void
    {
        $calculator = new Calculator();

        $this->expectException(
            InvalidArgumentException::class
        );

        $this->expectExceptionMessageIsOrContains(
            'Division par zéro interdite.'
        );

        $this->expectExceptionCode(1001);

        $this->calculator->divide(10, 0);
    }

    protected function tearDown(): void
    {
        //nettoyage
        //supprime l objet defini le test
        //suppression fichier tmporaire
        //
        unset($this->calculator);
    }
}
