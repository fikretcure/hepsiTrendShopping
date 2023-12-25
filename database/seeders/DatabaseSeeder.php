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
            'stock' => rand(50,1000),
            'desc' => 'Lastik Degisimi',
        ]);

        Category::create([
            'name' => 'Tesisat'
        ])->products()->create([
            'name' => 'Musluk Tamiri',
            'price' => 100,
            'stock' => rand(50,1000),
            'desc' => 'Musluk Tamiri',
        ]);

        Category::create([
            'name' => 'Ozel Ders'
        ])->products()->create([
            'name' => 'Matematik Dersi',
            'price' => 100,
            'stock' => rand(50,1000),
            'desc' => 'Matematik Dersi',
        ]);

        Category::create([
            'name' => 'Diger'
        ]);

        $category = Category::create([
            'name' => 'Kitap'
        ]);

        $category->products()->create([
            'name' => 'Fen Bilgisi',
            'price' => 100,
            'stock' => rand(50,1000),
            'desc' => 'Fen Bilgisi',
        ]);

        $category->products()->create([
            'name' => 'Turkce',
            'price' => 100,
            'stock' => rand(50,1000),
            'desc' => 'Turkce',
        ]);
    }
}
