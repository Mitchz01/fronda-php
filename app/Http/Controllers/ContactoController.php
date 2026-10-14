<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Clientes\ClienteValidator;
use App\Clientes\RegistrarCliente;
use App\Clientes\ValidationException;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use PDOException;

/**
 * Envío clásico del formulario (sin JavaScript): valida, guarda y redirige.
 */
final class ContactoController
{
    public function __construct(private readonly RegistrarCliente $registrar)
    {
    }

    public function enviar(Request $request): Response
    {
        $datos = $request->only(ClienteValidator::CAMPOS);

        if (!Csrf::valid(Csrf::fromRequest($request))) {
            return $this->volver($datos, error: 'Tu sesión expiró. Revisa los datos y envía de nuevo.');
        }

        // Campo trampa: las personas no lo ven, los bots sí lo llenan.
        if ($request->input('sitio_web')) {
            return Response::redirect(url('/'));
        }

        try {
            $cliente = ($this->registrar)($datos);
        } catch (ValidationException $e) {
            return $this->volver($datos, errores: $e->errores);
        } catch (PDOException $e) {
            error_log('[contacto] ' . $e->getMessage());

            return $this->volver($datos, error: 'No pudimos guardar tu mensaje. Intenta de nuevo en unos minutos.');
        }

        Session::flash('cliente_nombre', $cliente->primerNombre());

        return Response::redirect(url('/gracias'));
    }

    /**
     * @param array<string, string> $datos
     * @param array<string, string> $errores
     */
    private function volver(array $datos, array $errores = [], ?string $error = null): Response
    {
        Session::flash('old', $datos);
        Session::flash('errores', $errores);
        Session::flash('error_general', $error);

        return Response::redirect(url('/#contacto'));
    }
}
