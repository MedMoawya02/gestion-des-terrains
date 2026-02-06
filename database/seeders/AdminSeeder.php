<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'role'=>'admin',
            'email_verified_at' => now(),
            'password' => 'Admin', 
            'remember_token' => Str::random(10),
        ]);
    }
}
