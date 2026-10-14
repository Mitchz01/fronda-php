<?php

declare(strict_types=1);

namespace App\Core;

use Closure;

final class Router
{
    /** @var array<string, array<string, array{0: class-string, 1: string}>> */
    private array $routes = [];

    private ?Closure $notFound = null;

    public function __construct(private readonly Container $container)
    {
    }

    /** @param array{0: class-string, 1: string} $handler */
    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$this->normalize($path)] = $handler;
    }

    /** @param array{0: class-string, 1: string} $handler */
    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$this->normalize($path)] = $handler;
    }

    public function fallback(Closure $handler): void
    {
        $this->notFound = $handler;
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->method === 'HEAD' ? 'GET' : $request->method;
        $handler = $this->routes[$method][$request->path] ?? null;

        if ($handler === null) {
            $allowed = $this->allowedMethods($request->path);

            if ($allowed !== []) {
                return Response::json(['ok' => false, 'mensaje' => 'Método no permitido.'], 405)
                    ->withHeader('Allow', implode(', ', $allowed));
            }

            return $this->notFound !== null
                ? ($this->notFound)($request)
                : Response::html('No encontrado', 404);
        }

        [$class, $action] = $handler;
        $controller = $this->container->get($class);

        return $controller->{$action}($request);
    }

    /** @return list<string> */
    private function allowedMethods(string $path): array
    {
        return array_keys(array_filter($this->routes, static fn (array $routes) => isset($routes[$path])));
    }

    private function normalize(string $path): string
    {
        return '/' . trim($path, '/');
    }
}
