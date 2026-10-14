<?php

declare(strict_types=1);

use App\Core\Request;
use App\Http\Api\ClientesController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PaginaController;

/** @var App\Core\Router $router */
/** @var App\Core\Container $container */

$router->get('/', [PaginaController::class, 'inicio']);
$router->get('/gracias', [PaginaController::class, 'gracias']);
$router->post('/contacto', [ContactoController::class, 'enviar']);

$router->post('/api/clientes', [ClientesController::class, 'crear']);

$router->fallback(static fn (Request $request) => $container->get(PaginaController::class)->noEncontrado($request));
