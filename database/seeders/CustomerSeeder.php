<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '1234567890',
                'DOB' => '1990-01-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '0987654321',
                'DOB' => '1985-07-24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Johnson',
                'email' => null, // Email is nullable
                'phone' => null, // Phone is nullable
                'DOB' => '2000-11-05',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
