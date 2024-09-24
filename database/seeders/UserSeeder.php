<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();

        $users = [
            ['id' => 1, 'name' => 'Admin', 'user_group' => '1', 'email' => 'admin@gmail.com', 'password' => bcrypt('Admin123@')],
            ['id' => 2, 'name' => 'Customer', 'user_group' => '2', 'email' => 'customer@gmail.com', 'password' => bcrypt('Customer123@')],
        ];

        User::insert($users);
    }
}