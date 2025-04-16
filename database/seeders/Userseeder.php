<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
            $user->email = 'admin@gmail.com';
            $user->name = 'Admin';
            $user->phone = '0771234567';
            $user->Nic = '123456789V';
            $user->status = 'active';
            $user->password = Hash::make('admin');
            $user->save();
            $user->assignRole('Super Admin');

    }
}
