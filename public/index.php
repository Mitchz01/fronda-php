<?php

declare(strict_types=1);

use App\Core\Request;
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

$router->dispatch($request)->send();
