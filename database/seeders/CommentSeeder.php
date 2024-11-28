<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Crear 100 comentarios
        foreach (range(1, 100) as $index) {
            Comment::create([
                'content' => $faker->paragraph(2),
                'user_id' => User::inRandomOrder()->first()->id,
                'news_id' => News::inRandomOrder()->first()->id,
            ]);
        }
    }
}
