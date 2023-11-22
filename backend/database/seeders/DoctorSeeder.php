<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'doctor',
            'email' => 'doctor@admin.nl',
            'password' => bcrypt('doctor'),
            'role' => 'doctor',
        ]);
    }
}
