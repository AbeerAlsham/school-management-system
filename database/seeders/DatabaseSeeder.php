<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\Accounts\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => "manager",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(2);

        $user = User::create([
            'username' => "teacherabeer",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(1);

        $user = User::create([
            'username' => "teacherasmaa",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(1);
        $user = User::create([
            'username' => "teachernoura",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(1);
    }
}
