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
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$YaHPyXEi6yt1IfNEJ/OqoOG2mkYWrys6WdI4lz61QZW8UNOTDStPS',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 2,
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => '$2y$10$HVUecFZp5nW14SqgP0H1UORLkHmusVibHzxoIbxwr3eolXffcFiq.',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 1
            ]
        ]);
    }
}
