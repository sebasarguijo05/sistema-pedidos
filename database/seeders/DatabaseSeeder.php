<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Crear usuario normal
        User::create([
            'name' => 'Usuario Demo',
            'email' => 'usuario@usuario.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        // Crear productos de ejemplo
        $productos = [
            [
                'nombre' => 'Laptop HP Pavilion',
                'descripcion' => 'Laptop HP Pavilion con procesador Intel Core i5, 8GB RAM, 256GB SSD, pantalla de 15.6 pulgadas.',
                'precio' => 599.99,
                'stock' => 15,
                'activo' => true,
            ],
            [
                'nombre' => 'Mouse Logitech MX Master 3',
                'descripcion' => 'Mouse inalámbrico ergonómico con sensor de alta precisión, ideal para profesionales.',
                'precio' => 89.99,
                'stock' => 30,
                'activo' => true,
            ],
            [
                'nombre' => 'Teclado Mecánico RGB',
                'descripcion' => 'Teclado mecánico con switches Cherry MX, iluminación RGB personalizable.',
                'precio' => 129.99,
                'stock' => 20,
                'activo' => true,
            ],
            [
                'nombre' => 'Monitor LG 27 pulgadas 4K',
                'descripcion' => 'Monitor UHD 4K de 27 pulgadas con tecnología IPS, ideal para diseño y gaming.',
                'precio' => 399.99,
                'stock' => 10,
                'activo' => true,
            ],
            [
                'nombre' => 'Auriculares Sony WH-1000XM4',
                'descripcion' => 'Auriculares inalámbricos con cancelación de ruido líder en la industria.',
                'precio' => 349.99,
                'stock' => 25,
                'activo' => true,
            ],
            [
                'nombre' => 'Webcam Logitech C920',
                'descripcion' => 'Webcam Full HD 1080p con enfoque automático y corrección de luz.',
                'precio' => 69.99,
                'stock' => 40,
                'activo' => true,
            ],
            [
                'nombre' => 'Disco Duro Externo 2TB',
                'descripcion' => 'Disco duro externo portátil de 2TB con USB 3.0, ideal para respaldos.',
                'precio' => 79.99,
                'stock' => 35,
                'activo' => true,
            ],
            [
                'nombre' => 'Router WiFi 6 TP-Link',
                'descripcion' => 'Router de última generación WiFi 6 con velocidades de hasta 3000 Mbps.',
                'precio' => 149.99,
                'stock' => 18,
                'activo' => true,
            ],
            [
                'nombre' => 'Tablet Samsung Galaxy Tab S7',
                'descripcion' => 'Tablet Android con pantalla de 11 pulgadas, procesador Snapdragon y S Pen incluido.',
                'precio' => 649.99,
                'stock' => 12,
                'activo' => true,
            ],
            [
                'nombre' => 'Impresora HP LaserJet',
                'descripcion' => 'Impresora láser monocromática con WiFi, perfecta para oficina en casa.',
                'precio' => 199.99,
                'stock' => 8,
                'activo' => true,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}