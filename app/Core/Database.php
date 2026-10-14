<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

final class Database
{
    /**
     * @param array{host: string, port: int, database: string, username: string, password: string, charset: string} $config
     */
    public static function connect(array $config): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['database'],
            $config['charset'],
        );

        $pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        // Misma zona horaria que PHP para que creado_en se lea bien.
        $pdo->exec(sprintf("SET time_zone = '%s'", date('P')));

        return $pdo;
    }
}
