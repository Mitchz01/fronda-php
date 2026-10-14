<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;

final class PaginaController
{
    /** @param array<string, mixed> $site */
    public function __construct(private readonly array $site)
    {
    }

    public function inicio(Request $request): Response
    {
        return Response::html(View::page('inicio', [
            'title' => 'Fronda · Plantas para interiores en Santa Marta',
            'site' => $this->site,
            'old' => Session::pull('old', []),
            'errores' => Session::pull('errores', []),
            'errorGeneral' => Session::pull('error_general'),
        ]));
    }

    public function gracias(Request $request): Response
    {
        $nombre = Session::pull('cliente_nombre');

        if ($nombre === null) {
            return Response::redirect(url('/'));
        }

        return Response::html(View::page('gracias', [
            'title' => 'Mensaje enviado · Fronda',
            'site' => $this->site,
            'nombre' => $nombre,
        ]));
    }

    public function noEncontrado(Request $request): Response
    {
        return Response::html(View::page('404', [
            'title' => 'Página no encontrada · Fronda',
            'site' => $this->site,
        ]), 404);
    }
}
