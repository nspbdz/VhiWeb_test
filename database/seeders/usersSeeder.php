<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'is_active' => 1,
            'name' => 'User',
        ]);

        $user = User::create([
            'email' => 'user2@gmail.com',
            'password' => Hash::make('12345678'),
            'is_active' => 1,
            'name' => ' User2',
        ]);
    }
}
