<?php

declare(strict_types=1);

namespace App\Clientes;

use Closure;
use PDO;

final class PdoClienteRepository implements ClienteRepository
{
    private ?PDO $pdo = null;

    /**
     * Recibe una función que abre la conexión, así solo se conecta
     * a MySQL cuando de verdad se va a leer o escribir.
     *
     * @param Closure(): PDO $connect
     */
    public function __construct(private readonly Closure $connect)
    {
    }

    public function guardar(Cliente $cliente): Cliente
    {
        $sql = 'INSERT INTO Clientes (nombre, domicilio, telefono, correo, comentarios)
                VALUES (:nombre, :domicilio, :telefono, :correo, :comentarios)';

        $this->pdo()->prepare($sql)->execute([
            'nombre' => $cliente->nombre,
            'domicilio' => $cliente->domicilio,
            'telefono' => $cliente->telefono,
            'correo' => $cliente->correo,
            'comentarios' => $cliente->comentarios,
        ]);

        return $cliente->conId((int) $this->pdo()->lastInsertId());
    }

    public function recientes(int $limite = 50): array
    {
        $stmt = $this->pdo()->prepare(
            'SELECT id, nombre, domicilio, telefono, correo, comentarios, creado_en
               FROM Clientes
           ORDER BY creado_en DESC, id DESC
              LIMIT :limite'
        );
        $stmt->bindValue('limite', $limite, PDO::PARAM_INT);
        $stmt->execute();

        return array_map(Cliente::desdeFila(...), $stmt->fetchAll());
    }

    public function total(): int
    {
        return (int) $this->pdo()->query('SELECT COUNT(*) FROM Clientes')->fetchColumn();
    }

    private function pdo(): PDO
    {
        return $this->pdo ??= ($this->connect)();
    }
}
