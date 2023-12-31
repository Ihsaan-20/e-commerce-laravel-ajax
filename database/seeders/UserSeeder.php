<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // admin data
            [
                'name'=> 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ],

            // user data
            [
                'name'=> 'User Ihsan',
                'email' => 'ihsan@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'user'
            ]
        ]);

    }
}
