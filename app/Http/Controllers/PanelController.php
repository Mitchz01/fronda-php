<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Clientes\ClienteRepository;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use PDOException;

/**
 * Listado de los mensajes guardados en la tabla Clientes.
 * Protegido con usuario y clave del .env (autenticación básica HTTP).
 */
final class PanelController
{
    /** @param array{user: string, password: string} $credenciales */
    public function __construct(
        private ClienteRepository $clientes,
        private array $credenciales,
    ) {
    }

    public function index(Request $request): Response
    {
        if (!$this->autorizado($request)) {
            return new Response('Acceso restringido', 401, [
                'Content-Type' => 'text/plain; charset=utf-8',
                'WWW-Authenticate' => 'Basic realm="Panel Fronda", charset="UTF-8"',
            ]);
        }

        $error = null;

        try {
            $clientes = $this->clientes->recientes(100);
            $total = $this->clientes->total();
        } catch (PDOException $e) {
            error_log('[panel] ' . $e->getMessage());
            [$clientes, $total] = [[], 0];
            $error = 'No hay conexión con la base de datos. Revisa los datos de acceso en el archivo .env.';
        }

        return Response::html(View::page('panel', [
            'title' => 'Mensajes · Fronda',
            'bare' => true,
            'clientes' => $clientes,
            'total' => $total,
            'error' => $error,
        ]))
            ->withHeader('Cache-Control', 'no-store')
            ->withHeader('X-Robots-Tag', 'noindex');
    }

    private function autorizado(Request $request): bool
    {
        if ($this->credenciales['password'] === '') {
            return false;
        }

        $usuario = $request->server('PHP_AUTH_USER');
        $clave = $request->server('PHP_AUTH_PW');

        // Algunos servidores no llenan PHP_AUTH_*, se lee la cabecera a mano.
        $cabecera = $request->header('authorization') ?? $request->server('REDIRECT_HTTP_AUTHORIZATION');
        if ($usuario === null && $cabecera !== null && str_starts_with($cabecera, 'Basic ')) {
            [$usuario, $clave] = explode(':', (string) base64_decode(substr($cabecera, 6)), 2) + [null, null];
        }

        return hash_equals($this->credenciales['user'], (string) $usuario)
            && hash_equals($this->credenciales['password'], (string) $clave);
    }
}
