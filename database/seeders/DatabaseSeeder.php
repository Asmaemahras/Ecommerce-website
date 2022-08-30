<?php

namespace Database\Seeders;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // la fonction qui crée automatiquement 5 users chacun a 3 orders de 2 produits
        User::factory()
        ->count(5)
        ->has(
            Order::factory()
                ->count(3)
                ->hasAttached(
                    Product::factory()->count(2),
                    ['total_price' => rand(10, 70), 'total_quantity' => rand(1, 3)]
                )
        )
        ->create();
    }
}
