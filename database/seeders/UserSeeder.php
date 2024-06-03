<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id' => Str::uuid(),
                'firstname' => 'Dani',
                'lastname' => 'Wahyudi',
                'username' => 'daniwahyudi13',
                'email' => 'daniwahyudi13@gmail.com',
                'password' => bcrypt('password123'),
                'isadmin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'firstname' => 'Satya',
                'lastname' => 'Mahendra',
                'username' => 'satya13',
                'email' => 'satyam13@gmail.com',
                'password' => bcrypt('password123'),
                'isadmin' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'firstname' => 'Sintia',
                'lastname' => 'Maharani',
                'username' => 'sintiamaharani13',
                'email' => 'sintiam13@gmail.com',
                'password' => bcrypt('password123'),
                'isadmin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
