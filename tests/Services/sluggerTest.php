<?php

namespace App\Tests\Services;

use PHPUnit\Framework\TestCase;
use Slugger;

class sluggerTest extends TestCase
{
    #[DataProvider('slugPoriver')]
    public function tesSlugify(
        string $input,
        string $expected

    ): void

    {
        $slugger = new Slugger();
        $this->assertSame(
            $expected,
            $slugger->slugify($input)
        );
    }

    public function testSlugify(): void
    {
        $this->assertTrue(true);
    }
    
    public static function slugPovider ():array
    {
        return [
            'phrase simple'=> [
                'Bonjour le monde',
                'bonjour-lemonde',
            ],

            'espace autour'=>[
             'Bonjour',
             'bonjour',
            ],
             'déjà minuscule'=>[
             'test simple',
             'test-simple',
            ],
        ]
    }
}
