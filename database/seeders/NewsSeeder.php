<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Crear 50 noticias
        foreach (range(1, 50) as $index) {
            News::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph(5),  // Lorem Ipsum
                'category_id' => Category::inRandomOrder()->first()->id,  // Asignar categoría aleatoria
                'user_id' => User::inRandomOrder()->first()->id,  // Asignar usuario aleatorio
                'image_url' => 'https://picsum.photos/400/300?random=' . rand(1, 1000),
            ]);
        }
    }
}
