<?php

namespace App\Services;

class ReadingTimeCalculator
{
    public function calculate(string $content): int
    {
        $words = str_word_count(
            strip_tags($content)
        );

        return max(1, (int) ceil($words / 200));
    }
}
