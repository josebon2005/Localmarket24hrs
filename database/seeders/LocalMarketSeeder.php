<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Commerce;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LocalMarketSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@localmarket.com'],
            [
                'name' => 'Admin LocalMarket',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'activo',
            ]
        );

        $comprador = User::updateOrCreate(
            ['email' => 'comprador@localmarket.com'],
            [
                'name' => 'Comprador Demo',
                'password' => Hash::make('password'),
                'role' => 'usuario',
                'status' => 'activo',
            ]
        );

        $comerciante1 = User::updateOrCreate(
            ['email' => 'comerciante1@localmarket.com'],
            [
                'name' => 'Comerciante Comida',
                'password' => Hash::make('password'),
                'role' => 'comerciante',
                'status' => 'activo',
            ]
        );

        $comerciante2 = User::updateOrCreate(
            ['email' => 'comerciante2@localmarket.com'],
            [
                'name' => 'Comerciante Ropa',
                'password' => Hash::make('password'),
                'role' => 'comerciante',
                'status' => 'activo',
            ]
        );

        $categoriaComida = Category::updateOrCreate(
            ['name' => 'Comida'],
            [
                'description' => 'Comercios de comida y bebidas.',
                'status' => 'activa',
            ]
        );

        $categoriaRopa = Category::updateOrCreate(
            ['name' => 'Ropa'],
            [
                'description' => 'Tiendas de ropa, zapatos y accesorios.',
                'status' => 'activa',
            ]
        );

        $categoriaTecnologia = Category::updateOrCreate(
            ['name' => 'Tecnología'],
            [
                'description' => 'Comercios de productos tecnológicos.',
                'status' => 'activa',
            ]
        );

        $comercioComida = Commerce::updateOrCreate(
            ['user_id' => $comerciante1->id],
            [
                'category_id' => $categoriaComida->id,
                'name' => 'Comedor La Bendición',
                'description' => 'Venta de comida casera, desayunos y almuerzos.',
                'address' => 'Zona 1',
                'phone' => '5555-1111',
                'status' => 'activo',
            ]
        );

        $comercioRopa = Commerce::updateOrCreate(
            ['user_id' => $comerciante2->id],
            [
                'category_id' => $categoriaRopa->id,
                'name' => 'Moda Express',
                'description' => 'Venta de ropa casual para dama y caballero.',
                'address' => 'Zona 4',
                'phone' => '5555-2222',
                'status' => 'activo',
            ]
        );

        Product::updateOrCreate(
            [
                'commerce_id' => $comercioComida->id,
                'name' => 'Desayuno chapín',
            ],
            [
                'description' => 'Huevos, frijoles, plátanos y tortillas.',
                'price' => 28.00,
                'stock' => 20,
                'discount_percentage' => 0,
                'status' => 'activo',
            ]
        );

        Product::updateOrCreate(
            [
                'commerce_id' => $comercioComida->id,
                'name' => 'Almuerzo ejecutivo',
            ],
            [
                'description' => 'Incluye carne, arroz, ensalada y bebida.',
                'price' => 35.00,
                'stock' => 15,
                'discount_percentage' => 10,
                'status' => 'activo',
            ]
        );

        Product::updateOrCreate(
            [
                'commerce_id' => $comercioRopa->id,
                'name' => 'Camisa casual',
            ],
            [
                'description' => 'Camisa cómoda para uso diario.',
                'price' => 75.00,
                'stock' => 12,
                'discount_percentage' => 5,
                'status' => 'activo',
            ]
        );

        Product::updateOrCreate(
            [
                'commerce_id' => $comercioRopa->id,
                'name' => 'Pantalón de lona',
            ],
            [
                'description' => 'Pantalón resistente de lona.',
                'price' => 120.00,
                'stock' => 8,
                'discount_percentage' => 0,
                'status' => 'activo',
            ]
        );
    }
}
