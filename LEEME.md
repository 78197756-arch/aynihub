# AyniHub — cómo ponerlo a correr

Este zip es una **capa (overlay)** que va ENCIMA de un proyecto Laravel 11 o 12 nuevo.
Incluye tus archivos originales + los que faltaban (modelos, migraciones, rutas, políticas,
seeders, SecurityHeaders, CSS base, idiomasExtra.js).

## Requisitos
PHP 8.2+ (con pdo_sqlite) y Composer. En Windows sirve XAMPP o Laravel Herd.

## Pasos (en una terminal)
```bash
composer create-project laravel/laravel ayni
# copia TODO el contenido de esta carpeta (AyniHub-overlay) dentro de ayni/, aceptando "reemplazar"
cd ayni
cp .env.example .env            # en Windows: copy .env.example .env
php artisan key:generate
```
En `.env` deja/pon:
```
APP_LOCALE=es
APP_FALLBACK_LOCALE=es
DB_CONNECTION=sqlite
```
(crea el archivo vacío `database/database.sqlite` si no existe)
```bash
php artisan migrate:fresh --seed
php artisan test
php artisan serve
```
Abre http://127.0.0.1:8000

## Usuarios de prueba
| Rol | Usuario | Contraseña |
|---|---|---|
| Gestor | gestor@aynihub.pe | Gestor#2026 |
| Productor | productor@aynihub.pe | Productor#2026 |
| Comprador | comprador@aynihub.pe | Comprador#2026 |

## Pendiente de tu lado
- Las imágenes (`public/images/`: portada1-3.jpg, papa1.jpg, entrevista-*.jpg) no venían en el zip: cópialas de tu proyecto.
- Si tienes tus CSS originales (variables, base, estructura, componentes, formularios, adaptable), úsalos en lugar de los generados aquí.
- Revisa el quechua de `idiomasExtra.js` con un hablante nativo.
