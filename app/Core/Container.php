<?php

declare(strict_types=1);

namespace App\Core;

use Closure;
use RuntimeException;

/**
 * Contenedor mínimo: registra fábricas y entrega una sola instancia por servicio.
 */
final class Container
{
    /** @var array<string, Closure> */
    private array $factories = [];

    /** @var array<string, mixed> */
    private array $instances = [];

    public function set(string $id, Closure $factory): void
    {
        $this->factories[$id] = $factory;
        unset($this->instances[$id]);
    }

    public function get(string $id): mixed
    {
        if (array_key_exists($id, $this->instances)) {
            return $this->instances[$id];
        }

        if (!isset($this->factories[$id])) {
            throw new RuntimeException("Servicio no registrado: {$id}");
        }

        return $this->instances[$id] = ($this->factories[$id])($this);
    }
}
