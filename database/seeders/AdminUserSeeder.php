<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'elang@dlh'], // agar tidak dobel kalau dijalankan ulang
            [
                'name' => 'Admin DLH',
                'password' => bcrypt('12345678'), 
                'role' => 'admin',
                'is_verified' => true,
            ]
        );
    }
}
