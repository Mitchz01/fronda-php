<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

final class Database
{
    private const BASE_NO_EXISTE = 1049;

    /**
     * @param array{host: string, port: int, database: string, username: string, password: string, charset: string} $config
     */
    public static function connect(array $config): PDO
    {
        try {
            $pdo = self::open($config, $config['database']);
        } catch (PDOException $e) {
            // Primera vez en un XAMPP limpio: la base no existe, se crea con database/schema.sql.
            if ((int) $e->getCode() !== self::BASE_NO_EXISTE) {
                throw $e;
            }

            self::install($config);
            $pdo = self::open($config, $config['database']);
        }

        // Misma zona horaria que PHP para que creado_en se lea bien.
        $pdo->exec(sprintf("SET time_zone = '%s'", date('P')));

        return $pdo;
    }

    private static function open(array $config, ?string $database): PDO
    {
        $dsn = sprintf('mysql:host=%s;port=%d;charset=%s', $config['host'], $config['port'], $config['charset']);

        if ($database !== null) {
            $dsn .= ";dbname={$database}";
        }

        return new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    /**
     * Crea la base con el nombre configurado y corre las tablas de schema.sql.
     */
    private static function install(array $config): void
    {
        $pdo = self::open($config, null);
        $database = str_replace('`', '', $config['database']);

        $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `{$database}`");

        $sql = preg_replace('/^\s*--.*$/m', '', (string) file_get_contents(BASE_PATH . '/database/schema.sql'));

        foreach (array_filter(array_map('trim', explode(';', $sql))) as $statement) {
            // El nombre de la base ya lo puso la configuración.
            if (preg_match('/^(CREATE DATABASE|USE)\b/i', $statement)) {
                continue;
            }

            $pdo->exec($statement);
        }
    }
}
