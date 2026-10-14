<?php

declare(strict_types=1);

namespace App\Clientes;

interface ClienteRepository
{
    public function guardar(Cliente $cliente): Cliente;

    /** @return list<Cliente> */
    public function recientes(int $limite = 50): array;

    public function total(): int;
}
