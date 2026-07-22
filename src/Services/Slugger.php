<?php

namespace App\Services;

class Slugger
{
    public function slugify(string $test): string
    {
        return strtolower(
            str_replace(' ', '-', trim($test))
        );
    }
}
