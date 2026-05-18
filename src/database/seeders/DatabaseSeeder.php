<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'content' => '1. 商品のお届けについて', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'content' => '2. 商品の交換について', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'content' => '3. 商品トラブル', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'content' => '4. ショップへのお問い合わせ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'content' => '5. その他', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
