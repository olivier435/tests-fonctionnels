<?php

namespace App\Tests\Services;

use PHPUnit\Framework\TestCase;

class FileGeneratorTest extends TestCase
{
    private string $file;

    protected function setUp(): void
    {

        $this->file = 'test.txt';

        file_put_contents(
            $this->file,
            'Test'
        );
    }

    protected function tearDown(): void
    {
        //libere la ressource
        unlink($this->file);
    }

    public function testFileExists(): void
    {
        $this->assertFileExists(
            $this->file
        );
    }
}
