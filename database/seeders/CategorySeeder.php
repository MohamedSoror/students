<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'الفيزياء'
        ]);
        Category::create([
            'title' => 'الفيزياء وعلوم الحاسب'
        ]);
        Category::create([
            'title' => 'الفيزياء وعلوم الليزر'
        ]);
        Category::create([
            'title' => 'الفيزياء والكيمياء'
        ]);
    }
}
