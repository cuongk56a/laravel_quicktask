<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'cuongk56a',
            'first_name' => 'Nguyen',
            'last_name' => 'Cuong',
            'email' => 'cuongk56a@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'is_admin' => true,
            'is_active' => true,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
