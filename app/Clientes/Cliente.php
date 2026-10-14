<?php

declare(strict_types=1);

namespace App\Clientes;

use DateTimeImmutable;

final class Cliente
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $domicilio,
        public readonly string $telefono,
        public readonly string $correo,
        public readonly string $comentarios,
        public readonly ?int $id = null,
        public readonly ?DateTimeImmutable $creadoEn = null,
    ) {
    }

    /** @param array<string, mixed> $fila */
    public static function desdeFila(array $fila): self
    {
        return new self(
            nombre: $fila['nombre'],
            domicilio: $fila['domicilio'],
            telefono: $fila['telefono'],
            correo: $fila['correo'],
            comentarios: $fila['comentarios'],
            id: (int) $fila['id'],
            creadoEn: new DateTimeImmutable($fila['creado_en']),
        );
    }

    public function conId(int $id): self
    {
        return new self(
            $this->nombre,
            $this->domicilio,
            $this->telefono,
            $this->correo,
            $this->comentarios,
            $id,
            $this->creadoEn ?? new DateTimeImmutable(),
        );
    }

    public function primerNombre(): string
    {
        return explode(' ', $this->nombre)[0];
    }
}
