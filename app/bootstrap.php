<?php

declare(strict_types=1);

use App\Clientes\ClienteRepository;
use App\Clientes\ClienteValidator;
use App\Clientes\PdoClienteRepository;
use App\Clientes\RegistrarCliente;
use App\Core\Container;
use App\Core\Database;
use App\Core\Env;
use App\Http\Controllers\PaginaController;

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

require BASE_PATH . '/app/helpers.php';

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

// La conexión se abre solo cuando algo la pide, así el sitio carga aunque MySQL esté apagado.
$container->set(PDO::class, static fn () => Database::connect($config['database']));

$container->set(ClienteRepository::class, static fn (Container $c) => new PdoClienteRepository($c->get(PDO::class)));
$container->set(RegistrarCliente::class, static fn (Container $c) => new RegistrarCliente(
    $c->get(ClienteRepository::class),
    new ClienteValidator(),
));

$container->set('site', static fn () => require BASE_PATH . '/content/sitio.php');
$container->set(PaginaController::class, static fn (Container $c) => new PaginaController($c->get('site')));

return $container;
