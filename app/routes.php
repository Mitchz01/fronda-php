<?php

declare(strict_types=1);

use App\Core\Request;
use App\Core\Response;

/** @var App\Core\Router $router */

$router->fallback(static fn (Request $request) => Response::html('No encontrado', 404));
