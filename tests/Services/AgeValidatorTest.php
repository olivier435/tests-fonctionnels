<?php

namespace App\Tests\Services;

use App\Services\AgeValidator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class AgeValidatorTest extends TestCase
{
    #[DataProvider('invalidAgeProvider')]
    public function testInvalidAgeThrowException(int $age): void
    {
        $validator = new AgeValidator();

        $this->expectException(
            InvalidArgumentException::class
        );

        $validator->validate($age);
    }

    public static function invalidAgeProvider(): array
    {
        return [
            'âge négatif' => [-1],
            'âge impossible' => [150],
        ];
    }
}
