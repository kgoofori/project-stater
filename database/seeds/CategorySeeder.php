<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => 'Guest House', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hotel', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
