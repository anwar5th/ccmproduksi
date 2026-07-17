<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Engineering & Estimator',
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 1,
            ],
            [
                'name' => 'Admin Produksi',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 2,
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@operator.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 3,
            ],
            [
                'name' => 'Administrator',
                'email' => 'administrator@administrator.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 4,
            ],
            [
                'name' => 'IT Support',
                'email' => 'it@it.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 5,
            ]
        ]);
    }
}

