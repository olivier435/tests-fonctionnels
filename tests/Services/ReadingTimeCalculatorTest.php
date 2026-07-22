<?php

namespace App\Tests\Services;

use App\Services\ReadingTimeCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ReadingTimeCalculatorTest extends TestCase
{
    #[DataProvider('readingTimeProvider')]
    public function testCalculateReadingTime(
        string $content,
        int $expectedMinute
    ): void {
        $calculator = new ReadingTimeCalculator();
        $this->assertEquals(
            $expectedMinute,
            $calculator->calculate($content)
        );
    }

    public static function readingTimeProvider(): array
    {
        return [
            'teste vide' => [
                '',
                1,
            ],
            'teste court' => [
                'Bonjour tout le monde',
                1,
            ],
            'contenu HTML' => [
                '<p>Bonjour tout <strong>le monde</strong></p>',
                1,
            ],
            'teste long' => [
                str_repeat('mot ', 401),
                3,
            ],
        ];
    }
}
