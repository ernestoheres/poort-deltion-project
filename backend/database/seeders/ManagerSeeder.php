<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@admin.nl',
            'password' => bcrypt('manager'),
            'role' => 'manager',
        ]);

    }
}
