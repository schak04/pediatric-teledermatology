<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create Admin
        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@telederm.com',
            'password' => \Illuminate\Support\Facades\Hash::make('AdminPass123!'),
            'role' => 'admin',
        ]);

        // Create Doctor
        User::factory()->create([
            'name' => 'Dr. Smith',
            'email' => 'doctor@telederm.com',
            'password' => \Illuminate\Support\Facades\Hash::make('DoctorPass123!'),
            'role' => 'doctor',
        ]);

        // Create Patient
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'patient@telederm.com',
            'password' => \Illuminate\Support\Facades\Hash::make('PatientPass123!'),
            'role' => 'patient',
        ]);
    }
}
