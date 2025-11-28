<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SelectionSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Brimob',
            'email' => 'admin@brimob.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create Regular Users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Create Selection Schedules
        SelectionSchedule::create([
            'stage' => 'registrasi',
            'title' => 'Pendaftaran Tahap 1',
            'description' => 'Pendaftaran online untuk calon anggota Brimob',
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(30),
            'location' => 'Online',
            'quota' => 1000,
        ]);

        SelectionSchedule::create([
            'stage' => 'tes_kesehatan',
            'title' => 'Tes Kesehatan',
            'description' => 'Pemeriksaan kesehatan calon anggota',
            'start_date' => now()->addDays(35),
            'end_date' => now()->addDays(45),
            'location' => 'Pusat Kesehatan Polri Jakarta',
            'quota' => 800,
        ]);

        SelectionSchedule::create([
            'stage' => 'tes_fisik',
            'title' => 'Tes Fisik',
            'description' => 'Tes kemampuan fisik dan atletik',
            'start_date' => now()->addDays(50),
            'end_date' => now()->addDays(60),
            'location' => 'Markas Brimob Depok',
            'quota' => 600,
        ]);

        SelectionSchedule::create([
            'stage' => 'tes_psikologi',
            'title' => 'Tes Psikologi',
            'description' => 'Tes psikologi dan wawancara',
            'start_date' => now()->addDays(65),
            'end_date' => now()->addDays(75),
            'location' => 'Markas Brimob Depok',
            'quota' => 450,
        ]);

        SelectionSchedule::create([
            'stage' => 'wawancara',
            'title' => 'Wawancara',
            'description' => 'Wawancara dengan panel penguji',
            'start_date' => now()->addDays(80),
            'end_date' => now()->addDays(90),
            'location' => 'Markas Brimob Depok',
            'quota' => 300,
        ]);

        SelectionSchedule::create([
            'stage' => 'hasil_akhir',
            'title' => 'Pengumuman Hasil Akhir',
            'description' => 'Pengumuman hasil seleksi akhir',
            'start_date' => now()->addDays(95),
            'end_date' => now()->addDays(100),
            'location' => 'Portal Online',
            'quota' => 200,
        ]);
    }
}
