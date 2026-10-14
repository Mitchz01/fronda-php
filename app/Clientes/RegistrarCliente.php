<?php

declare(strict_types=1);

namespace App\Clientes;

/**
 * Caso de uso: recibe los datos crudos del formulario, los valida y los guarda.
 * Lo usan tanto el formulario clásico como la API, así la regla vive en un solo lugar.
 */
final class RegistrarCliente
{
    public function __construct(
        private ClienteRepository $clientes,
        private ClienteValidator $validator,
    ) {
    }

    /**
     * @param array<string, string> $datos
     * @throws ValidationException
     */
    public function __invoke(array $datos): Cliente
    {
        $datos = $this->validator->normalizar($datos);
        $errores = $this->validator->validar($datos);

        if ($errores !== []) {
            throw new ValidationException($errores);
        }

        return $this->clientes->guardar(new Cliente(
            nombre: $datos['nombre'],
            domicilio: $datos['domicilio'],
            telefono: $datos['telefono'],
            correo: $datos['correo'],
            comentarios: $datos['comentarios'],
        ));
    }
}
