<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@klinik.test'], [
            'name' => 'Admin Klinik', 'password' => Hash::make('password'), 'role' => 'admin',
        ]);

        User::updateOrCreate(['email' => 'staf@klinik.test'], [
            'name' => 'Staf Klinik', 'password' => Hash::make('password'), 'role' => 'staf',
        ]);
    }
}