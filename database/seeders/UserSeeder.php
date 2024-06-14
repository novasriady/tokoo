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
                'firstname' => 'Nova',
                'lastname' => 'Sriady',
                'username' => 'nova',
                'email' => 'nova@gmail.com',
                'password' => bcrypt('12345'),
                'isadmin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'firstname' => 'Admin',
                'lastname' => 'Nova',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'isadmin' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
