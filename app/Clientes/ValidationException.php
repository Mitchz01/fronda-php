<?php

declare(strict_types=1);

namespace App\Clientes;

use RuntimeException;

final class ValidationException extends RuntimeException
{
    /** @param array<string, string> $errores */
    public function __construct(public readonly array $errores)
    {
        parent::__construct('Revisa los datos del formulario.');
    }
}
