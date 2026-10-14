<?php

declare(strict_types=1);

use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Core\Session;
use App\Core\View;

// Con el servidor embebido (php -S) los archivos estáticos se sirven tal cual.
if (PHP_SAPI === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

$container = require dirname(__DIR__) . '/app/bootstrap.php';

Session::start();

$request = Request::fromGlobals();
View::boot(BASE_PATH . '/views', $request->basePath);

$router = new Router($container);
require BASE_PATH . '/app/routes.php';

try {
    $response = $router->dispatch($request);
} catch (Throwable $e) {
    error_log((string) $e);

    if ($container->get('config')['app']['debug']) {
        throw $e;
    }

    $response = str_starts_with($request->path, '/api/')
        ? Response::json(['ok' => false, 'mensaje' => 'Algo salió mal. Intenta de nuevo.'], 500)
        : Response::html('<h1>Algo salió mal</h1><p>Intenta de nuevo en unos minutos.</p>', 500);
}

$response->send();
