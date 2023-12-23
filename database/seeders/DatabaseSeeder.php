<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Otomotiv'
        ])->products()->create([
            'name' => 'Lastik Degisimi',
            'price' => 100,
            'stock' => 10,
            'desc' => '1',
            'avatar' => '1',
            'is_daily' => 1
        ]);

        Category::create([
            'name' => 'Tesisat'
        ])->products()->create([
            'name' => 'Musluk Tamiri',
            'price' => 100,
            'stock' => 10,
            'desc' => '1',
            'avatar' => '1',
            'is_daily' => 1
        ]);

        Category::create([
            'name' => 'Ozel Ders'
        ])->products()->create([
            'name' => 'Matematik Dersi',
            'price' => 100,
            'stock' => 10,
            'desc' => '1',
            'avatar' => '1',
            'is_daily' => 1
        ]);

        Category::create([
            'name' => 'Kitap'
        ])->products()->create([
            'name' => 'Fen Bilgisi',
            'price' => 100,
            'stock' => 1000,
            'desc' => '1',
            'avatar' => '1',
            'is_daily' => 0
        ]);
    }
}
