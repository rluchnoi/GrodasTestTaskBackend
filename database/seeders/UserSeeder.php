<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'id'       => User::ID_DEFAULT,
                'name'     => 'Default User',
                'email'    => env('DEFAULT_EMAIL'),
                'password' => Hash::make('12345678')
            ],
        ];

        foreach ($usersData as $userData) {
            if (!User::find($userData['id'])) {
                User::create($userData);
            }
        }
    }
}
