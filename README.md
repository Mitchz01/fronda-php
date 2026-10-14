# Fronda

Micro sitio de un estudio ficticio de plantas para interiores en Santa Marta. Tiene un formulario de contacto que guarda cada mensaje en la tabla `Clientes` de MySQL.

Hecho con PHP y MySQL, sin frameworks ni dependencias que instalar.

## Cómo abrirlo con XAMPP

1. Copia la carpeta del proyecto dentro de `C:\xampp\htdocs` y renómbrala a `fronda`.
2. Abre el panel de XAMPP y enciende **Apache** y **MySQL**.
3. Entra a [http://localhost/fronda](http://localhost/fronda).

Listo. La primera vez que alguien envía el formulario se crea sola la base `fronda` con su tabla `Clientes`.

Si prefieres crearla a mano: entra a phpMyAdmin, abre la pestaña **SQL** y pega el contenido de [`database/schema.sql`](database/schema.sql).

### Ver los mensajes guardados

[http://localhost/fronda/panel](http://localhost/fronda/panel)

- Usuario: `admin`
- Clave: `fronda`

### Si tu MySQL tiene otra clave o puerto

Copia `.env.example` como `.env` y cambia los datos. Por defecto usa lo que trae XAMPP: usuario `root` sin contraseña en `127.0.0.1:3306`.

Necesita PHP 8.0 o superior (cualquier XAMPP de 2021 en adelante).

## Cómo está organizado

```
app/
  Core/          piezas base: router, request, response, vistas, sesión, conexión
  Clientes/      todo lo del formulario: entidad, validación, repositorio y registro
  Http/          controladores de páginas, del formulario y de la API
  bootstrap.php  carga la configuración y arma las dependencias
  routes.php     rutas del sitio
config/          configuración de la app y de la base de datos
content/         textos, fotos y videos del sitio
database/        script SQL de la tabla Clientes
public/          lo único visible desde el navegador: index.php, css, js
views/           layout, páginas y componentes reutilizables
```

### Recorrido de un mensaje

```
formulario  ->  contacto.js  ->  POST /api/clientes  ->  ClientesController
            ->  RegistrarCliente  ->  ClienteValidator  ->  PdoClienteRepository
            ->  INSERT INTO Clientes
```

Si el navegador no tiene JavaScript, el formulario se envía normal a `POST /contacto` y pasa por el mismo `RegistrarCliente`. La validación vive en un solo lugar.

### Rutas

| Método | Ruta            | Qué hace                                  |
| ------ | --------------- | ----------------------------------------- |
| GET    | `/`             | Página principal                          |
| POST   | `/contacto`     | Envío clásico del formulario              |
| POST   | `/api/clientes` | Envío por JSON, responde 201 o 422        |
| GET    | `/gracias`      | Confirmación después del envío clásico    |
| GET    | `/panel`        | Lista de clientes registrados             |

### Seguridad básica

- Consultas preparadas con PDO, nada de concatenar SQL.
- Token CSRF en el formulario y en la API.
- Campo trampa contra bots.
- Todo lo que se imprime pasa por `htmlspecialchars`.
- Solo `public/` queda expuesta; `app`, `config` y `.env` no se pueden abrir desde el navegador.

## Créditos

- Fotos y videos: [Pexels](https://www.pexels.com)
- Íconos: [Hugeicons](https://hugeicons.com)
