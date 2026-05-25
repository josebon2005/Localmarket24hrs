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
        User::updateOrCreate(
            ['email' => 'admin@localmarket.com'],
            [
                'name' => 'Admin LocalMarket',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'activo',
            ]
        );

        User::updateOrCreate(
            ['email' => 'comprador@localmarket.com'],
            [
                'name' => 'Comprador Demo',
                'password' => Hash::make('password'),
                'role' => 'usuario',
                'status' => 'activo',
            ]
        );

        $categories = [
            'Comida' => ['description' => 'Comercios de comida y bebidas.', 'status' => 'activa'],
            'Ropa' => ['description' => 'Tiendas de ropa, zapatos y accesorios.', 'status' => 'activa'],
            'Tecnologia' => ['description' => 'Comercios de productos tecnologicos.', 'status' => 'activa'],
            'Farmacia' => ['description' => 'Medicamentos, higiene y cuidado personal.', 'status' => 'activa'],
            'Hogar' => ['description' => 'Productos utiles para casa y limpieza.', 'status' => 'activa'],
        ];

        foreach ($categories as $name => $data) {
            $categories[$name] = Category::updateOrCreate(['name' => $name], $data);
        }

        $commerceData = [
            [
                'user' => ['email' => 'comerciante1@localmarket.com', 'name' => 'Comerciante Comida'],
                'commerce' => [
                    'category' => 'Comida',
                    'name' => 'Comedor La Bendicion',
                    'description' => 'Venta de comida casera, desayunos y almuerzos.',
                    'address' => 'Zona 1',
                    'phone' => '5555-1111',
                ],
                'products' => [
                    ['Desayuno chapin', 'Huevos, frijoles, platanos y tortillas.', 28.00, 20, 0],
                    ['Almuerzo ejecutivo', 'Incluye carne, arroz, ensalada y bebida.', 35.00, 15, 10],
                    ['Tamal colorado', 'Tamal tradicional con salsa roja y pan frances.', 18.00, 25, 0],
                    ['Cafe con pan dulce', 'Cafe caliente con dos piezas de pan dulce.', 16.00, 30, 5],
                    ['Caldo de res', 'Caldo con verduras, arroz y tortillas.', 42.00, 10, 0],
                ],
            ],
            [
                'user' => ['email' => 'comerciante2@localmarket.com', 'name' => 'Comerciante Ropa'],
                'commerce' => [
                    'category' => 'Ropa',
                    'name' => 'Moda Express',
                    'description' => 'Venta de ropa casual para dama y caballero.',
                    'address' => 'Zona 4',
                    'phone' => '5555-2222',
                ],
                'products' => [
                    ['Camisa casual', 'Camisa comoda para uso diario.', 75.00, 12, 5],
                    ['Pantalon de lona', 'Pantalon resistente de lona.', 120.00, 8, 0],
                    ['Blusa estampada', 'Blusa fresca para clima calido.', 68.00, 14, 10],
                    ['Gorra urbana', 'Gorra ajustable para uso diario.', 45.00, 20, 0],
                    ['Calcetines deportivos', 'Paquete de tres pares.', 32.00, 35, 0],
                ],
            ],
            [
                'user' => ['email' => 'comerciante3@localmarket.com', 'name' => 'Comerciante Tecnologia'],
                'commerce' => [
                    'category' => 'Tecnologia',
                    'name' => 'Tecno Barrio',
                    'description' => 'Accesorios, cables y tecnologia para uso diario.',
                    'address' => 'Zona 7',
                    'phone' => '5555-3333',
                ],
                'products' => [
                    ['Cable USB-C', 'Cable de carga rapida de un metro.', 35.00, 40, 0],
                    ['Audifonos bluetooth', 'Audifonos inalambricos con estuche.', 145.00, 9, 8],
                    ['Mouse inalambrico', 'Mouse compacto para laptop.', 85.00, 16, 0],
                    ['Cargador universal', 'Cargador de pared con dos puertos USB.', 95.00, 11, 5],
                    ['Protector de pantalla', 'Vidrio templado para smartphone.', 28.00, 50, 0],
                ],
            ],
            [
                'user' => ['email' => 'comerciante4@localmarket.com', 'name' => 'Comerciante Farmacia'],
                'commerce' => [
                    'category' => 'Farmacia',
                    'name' => 'Farmacia Salud 24',
                    'description' => 'Productos de salud, higiene y primeros auxilios.',
                    'address' => 'Zona 2',
                    'phone' => '5555-4444',
                ],
                'products' => [
                    ['Alcohol gel', 'Gel antibacterial de 250 ml.', 22.00, 30, 0],
                    ['Mascarillas', 'Caja con 20 mascarillas desechables.', 38.00, 18, 0],
                    ['Curitas familiares', 'Paquete surtido para primeros auxilios.', 18.00, 25, 0],
                    ['Shampoo suave', 'Shampoo familiar de uso diario.', 42.00, 13, 7],
                    ['Vitamina C', 'Suplemento de vitamina C en tabletas.', 55.00, 10, 0],
                ],
            ],
            [
                'user' => ['email' => 'comerciante5@localmarket.com', 'name' => 'Comerciante Hogar'],
                'commerce' => [
                    'category' => 'Hogar',
                    'name' => 'Hogar Practico',
                    'description' => 'Articulos para cocina, limpieza y organizacion.',
                    'address' => 'Zona 5',
                    'phone' => '5555-5555',
                ],
                'products' => [
                    ['Detergente liquido', 'Detergente para ropa de un litro.', 48.00, 22, 5],
                    ['Esponjas multiuso', 'Paquete de seis esponjas para cocina.', 15.00, 40, 0],
                    ['Organizador plastico', 'Caja organizadora mediana.', 65.00, 12, 0],
                    ['Toallas de cocina', 'Set de tres toallas absorbentes.', 36.00, 18, 0],
                    ['Desinfectante lavanda', 'Limpiador desinfectante de un litro.', 24.00, 28, 10],
                ],
            ],
        ];

        foreach ($commerceData as $item) {
            $user = User::updateOrCreate(
                ['email' => $item['user']['email']],
                [
                    'name' => $item['user']['name'],
                    'password' => Hash::make('password'),
                    'role' => 'comerciante',
                    'status' => 'activo',
                ]
            );

            $commerce = Commerce::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'category_id' => $categories[$item['commerce']['category']]->id,
                    'name' => $item['commerce']['name'],
                    'description' => $item['commerce']['description'],
                    'address' => $item['commerce']['address'],
                    'phone' => $item['commerce']['phone'],
                    'status' => 'activo',
                ]
            );

            foreach ($item['products'] as [$name, $description, $price, $stock, $discount]) {
                Product::updateOrCreate(
                    [
                        'commerce_id' => $commerce->id,
                        'name' => $name,
                    ],
                    [
                        'description' => $description,
                        'price' => $price,
                        'stock' => $stock,
                        'discount_percentage' => $discount,
                        'status' => 'activo',
                    ]
                );
            }
        }
    }
}
