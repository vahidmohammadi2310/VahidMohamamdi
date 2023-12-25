<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::insert([
            [
                'name' => 'admin',
                'email'=> 'admin@test.com',
                'password' => Hash::make('admin123'),
                'role' => 'Administrator'
            ],
            [
                'name' => 'Vahid Mohammadi',
                'email'=> 'user@test.com',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ],
        ]);
    }
}
