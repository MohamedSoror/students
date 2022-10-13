<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'محمد محمد محمد محمد',
            'category_id' => '1',
            'personal_email' => 'personal@personal.com',
            'collage_email' => 'faculty@faculty.com',
            'phone' => '01234567890',
            'another_phone' => '01123456789',
            'identify_num' => '30009211711111',
            'date_of_birth' => '25-10-2000',
        ]);
    }
}
