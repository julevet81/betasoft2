<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'admin@gmail.com',
            'status' => 'active',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'image' => 'default.png',
            'role_name' => json_encode(['admin']),
            'password' => bcrypt('12345678'),
        ]);
    }
}
