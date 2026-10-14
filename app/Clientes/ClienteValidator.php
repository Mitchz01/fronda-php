<?php

declare(strict_types=1);

namespace App\Clientes;

final class ClienteValidator
{
    public const CAMPOS = ['nombre', 'domicilio', 'telefono', 'correo', 'comentarios'];

    /**
     * Limpia espacios sobrantes y deja el correo en minúsculas.
     *
     * @param array<string, string> $datos
     * @return array<string, string>
     */
    public function normalizar(array $datos): array
    {
        $limpio = [];

        foreach (self::CAMPOS as $campo) {
            $valor = trim($datos[$campo] ?? '');
            $limpio[$campo] = $campo === 'comentarios'
                ? preg_replace("/\R{3,}/", "\n\n", $valor)
                : preg_replace('/\s+/', ' ', $valor);
        }

        $limpio['correo'] = mb_strtolower($limpio['correo']);

        return $limpio;
    }

    /**
     * @param array<string, string> $datos datos ya normalizados
     * @return array<string, string> errores por campo, vacío si todo está bien
     */
    public function validar(array $datos): array
    {
        $errores = [];

        $nombre = $datos['nombre'];
        if ($nombre === '') {
            $errores['nombre'] = 'Escribe tu nombre.';
        } elseif (mb_strlen($nombre) < 3 || mb_strlen($nombre) > 120) {
            $errores['nombre'] = 'El nombre debe tener entre 3 y 120 caracteres.';
        } elseif (!preg_match("/^[\p{L}\s.'-]+$/u", $nombre)) {
            $errores['nombre'] = 'El nombre solo puede tener letras y espacios.';
        }

        $domicilio = $datos['domicilio'];
        if ($domicilio === '') {
            $errores['domicilio'] = 'Necesitamos tu domicilio para agendar la visita.';
        } elseif (mb_strlen($domicilio) < 5 || mb_strlen($domicilio) > 200) {
            $errores['domicilio'] = 'El domicilio debe tener entre 5 y 200 caracteres.';
        }

        $telefono = $datos['telefono'];
        $digitos = preg_replace('/\D/', '', $telefono);
        if ($telefono === '') {
            $errores['telefono'] = 'Escribe un teléfono de contacto.';
        } elseif (!preg_match('/^\+?[\d\s()-]+$/', $telefono) || strlen($digitos) < 7 || strlen($digitos) > 15) {
            $errores['telefono'] = 'Ese teléfono no parece válido.';
        }

        $correo = $datos['correo'];
        if ($correo === '') {
            $errores['correo'] = 'Escribe tu correo electrónico.';
        } elseif (mb_strlen($correo) > 150 || filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
            $errores['correo'] = 'Revisa el formato del correo.';
        }

        $comentarios = $datos['comentarios'];
        if ($comentarios === '') {
            $errores['comentarios'] = 'Cuéntanos un poco sobre tu espacio.';
        } elseif (mb_strlen($comentarios) < 10) {
            $errores['comentarios'] = 'Escribe al menos 10 caracteres.';
        } elseif (mb_strlen($comentarios) > 1000) {
            $errores['comentarios'] = 'El mensaje no puede pasar de 1000 caracteres.';
        }

        return $errores;
    }
}
