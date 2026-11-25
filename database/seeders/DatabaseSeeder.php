<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/** Usuarios de prueba (uno por rol, cada uno con su propia contraseña) y productos de ejemplo. */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $crear = fn (string $rol, string $nombre, string $clave, ?string $ubicacion = null) => User::updateOrCreate(
            ['contact' => "$rol@aynihub.pe"],
            ['name' => $nombre, 'email' => "$rol@aynihub.pe", 'role' => $rol, 'location' => $ubicacion, 'password' => Hash::make($clave)]
        );

        $crear('gestor', 'Gestor AyniHub', 'Gestor#2026');
        $productor = $crear('productor', 'Familia Mamani', 'Productor#2026', 'Feria dominical, Chinchero');
        $crear('comprador', 'Ana Torres', 'Comprador#2026');

        if (Product::count() === 0) {
            $items = [
                ['agricola', 'Papa nativa', 2.50, 'kilo'], ['agricola', 'Maíz choclo', 1.80, 'unidad'],
                ['agricola', 'Oca morada', 3.00, 'kilo'], ['agricola', 'Habas frescas', 4.00, 'kilo'],
                ['artesanal', 'Chalina de alpaca', 65.00, 'unidad'], ['artesanal', 'Manta tejida', 120.00, 'unidad'],
            ];
            foreach ($items as [$cat, $nombre, $precio, $unidad]) {
                Product::create([
                    'user_id' => $productor->id, 'category' => $cat, 'name' => $nombre,
                    'producer_name' => $productor->name, 'price' => $precio, 'unit' => $unidad,
                    'location' => 'Feria dominical, Chinchero', 'description' => 'Producto de Chinchero, Cusco.',
                ]);
            }
        }
    }
}
