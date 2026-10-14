<?php

declare(strict_types=1);

namespace App\Http\Api;

use App\Clientes\ClienteValidator;
use App\Clientes\RegistrarCliente;
use App\Clientes\ValidationException;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use PDOException;

/**
 * POST /api/clientes
 *
 * Recibe JSON o form-data y responde siempre en JSON:
 *   201 { ok: true,  mensaje, cliente: { nombre } }
 *   422 { ok: false, mensaje, errores: { campo: mensaje } }
 *   419 { ok: false, mensaje }  token CSRF inválido
 *   503 { ok: false, mensaje }  base de datos no disponible
 */
final class ClientesController
{
    public function __construct(private readonly RegistrarCliente $registrar)
    {
    }

    public function crear(Request $request): Response
    {
        if (!Csrf::valid(Csrf::fromRequest($request))) {
            return Response::json([
                'ok' => false,
                'mensaje' => 'Tu sesión expiró. Recarga la página e intenta de nuevo.',
            ], 419);
        }

        if ($request->input('sitio_web')) {
            return Response::json(['ok' => true, 'mensaje' => 'Mensaje recibido.'], 201);
        }

        try {
            $cliente = ($this->registrar)($request->only(ClienteValidator::CAMPOS));
        } catch (ValidationException $e) {
            return Response::json([
                'ok' => false,
                'mensaje' => $e->getMessage(),
                'errores' => $e->errores,
            ], 422);
        } catch (PDOException $e) {
            error_log('[api/clientes] ' . $e->getMessage());

            return Response::json([
                'ok' => false,
                'mensaje' => 'No pudimos guardar tu mensaje. Intenta de nuevo en unos minutos.',
            ], 503);
        }

        return Response::json([
            'ok' => true,
            'mensaje' => 'Te escribimos en menos de 24 horas para agendar la visita.',
            'cliente' => ['nombre' => $cliente->primerNombre()],
        ], 201);
    }
}
