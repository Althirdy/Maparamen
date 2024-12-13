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
                'name' => 'John Doe', // Customize this
                'crew_id' => 'BM001', // Customize this
                'phone' => '09301420523', // Customize this
                'role' => 1, // Customize this
                'password' => Hash::make('password'), // Securely hash the password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith', // Customize this
                'crew_id' => 'C001', // Customize this
                'phone' => '09876543210', // Customize this
                'role' => 2, // Customize this
                'password' => Hash::make('password'), // Securely hash the password
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
