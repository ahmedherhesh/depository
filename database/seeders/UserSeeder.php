<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Manager',
                'username' => 'owner',
                'password' => 'secret',
                'role' => 'super-admin'
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => 'secret',
                'role' => 'admin'
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'password' => 'secret',
                'role' => 'user',
                'depot_id' => 1
            ],
        ];
        foreach($users as $user){
            User::create($user);
        }
    }
}
