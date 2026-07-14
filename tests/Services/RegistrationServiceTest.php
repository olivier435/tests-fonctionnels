<?php

namespace App\Tests\Services;

use App\Services\RegistrationService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RegistrationServiceTest extends TestCase
{
    public function testInvalidEmailThrowException(): void
    {
        $service = new RegistrationService();

        $this->expectException(
            InvalidArgumentException::class
        );
        $this->expectExceptionMessageIsOrContains(
            'Adresse email invalide.'
        );

        $service->register('toto');
    }
}
