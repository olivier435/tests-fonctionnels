<?php

namespace App\Tests\Services;

use App\Services\Calculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Metadata\DataProvider;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        //j instencie cet objet calculator
        $this->calculator = new Calculator();
    }
    #[DataProvider('additionProvider')]
    public function testAdd(int $a, int $b, int $expected): void
    {
        $this->assertSame(
            $expected,
            $this->calculator->add($a, $b)
        );
    }

    public static function additionProvider(): array
    {
        return [
            'addtion de deux nombre positifs' => [2, 2, 5],
            'addtion de deux zeros' => [0, 0, 0],
            'addtion négatif et positif' => [-2, 3, 1],
            'addtion de  granc nombre' => [10, 15, 25],
        ];
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
