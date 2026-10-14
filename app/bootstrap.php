<?php

declare(strict_types=1);

use App\Core\Container;
use App\Core\Env;

define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $file = BASE_PATH . '/app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

Env::load(BASE_PATH . '/.env');

$config = [
    'app' => require BASE_PATH . '/config/app.php',
    'database' => require BASE_PATH . '/config/database.php',
];

date_default_timezone_set($config['app']['timezone']);
ini_set('display_errors', $config['app']['debug'] ? '1' : '0');
error_reporting(E_ALL);

$container = new Container();
$container->set('config', static fn () => $config);

return $container;
