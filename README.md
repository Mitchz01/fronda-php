# Fronda

Práctica de PHP y MySQL. Había que hacer un formulario de contacto que guardara los datos en una tabla Clientes, así que me inventé un estudio de plantas en Santa Marta y le armé su página.

## Qué tiene

- Formulario de contacto que guarda en MySQL
- Se envía sin recargar la página
- Panel en `/panel` para ver los mensajes (admin / fronda)
- Modo oscuro y videos de Pexels

## Para correrlo

Pon la carpeta en `htdocs` con el nombre `fronda`, enciende Apache y MySQL en XAMPP y entra a `localhost/fronda`. La base de datos se crea sola.

## Estructura

```
app/        lógica y conexión
config/     configuración
content/    textos e imágenes
database/   script SQL
public/     index, css y js
views/      páginas y componentes
```
