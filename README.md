# AyniHub - Chinchero

Plataforma de comercio justo que conecta a productores y tejedoras de Chinchero con compradores. Hecha con Laravel 13, MySQL y Apache (XAMPP).

## Roles
- **Gestor**: panel de gestion, usuarios, pedidos y productos.
- **Productor**: sus productos y los pedidos recibidos.
- **Comprador**: catalogo y sus pedidos.

## Requisitos
- XAMPP con PHP 8.3 o superior, Apache y MySQL
- Composer
- Git

## Instalacion
1. Clonar en la carpeta de XAMPP:
   `cd C:\xampp\htdocs` y `git clone https://github.com/78197756-arch/aynihub.git ayni`
2. Instalar librerias: `cd ayni` y `composer install`
3. Copiar la configuracion: `copy .env.example .env`
4. En `.env` poner: `DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE=ayni`, `DB_USERNAME=root`, `DB_PASSWORD=` (vacio). Poner tambien `APP_LOCALE=es`.
5. Generar la clave: `php artisan key:generate`
6. En phpMyAdmin (http://localhost/phpmyadmin) crear la base de datos `ayni` con cotejamiento `utf8mb4_unicode_ci`.
7. Crear las tablas y los datos de ejemplo: `php artisan migrate --seed`

## Ejecutar con Apache
Agregar al final de `C:\xampp\apache\conf\httpd.conf`:

    Listen 8000
    <VirtualHost *:8000>
        DocumentRoot "C:/xampp/htdocs/ayni/public"
        <Directory "C:/xampp/htdocs/ayni/public">
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>

Iniciar Apache y MySQL en el Panel de XAMPP y abrir http://127.0.0.1:8000

Alternativa sin Apache: `php artisan serve` y abrir http://127.0.0.1:8000

## Usuarios de prueba
| Rol | Correo | Contrasena |
|---|---|---|
| Gestor | gestor@aynihub.pe | Gestor#2026 |
| Productor | productor@aynihub.pe | Productor#2026 |
| Comprador | comprador@aynihub.pe | Comprador#2026 |

Estas credenciales son solo de prueba para la demostracion.