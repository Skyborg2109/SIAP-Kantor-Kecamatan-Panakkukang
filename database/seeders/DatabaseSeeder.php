<?php

namespace Database\Seeders;

use App\Models\Counter;
use App\Models\Service;
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
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'ADMIN',
        ]);

        $posPelayanan = Counter::create(['name' => 'Ruang Pelayanan', 'status' => true]);

        User::create([
            'name' => 'Petugas Pelayanan',
            'email' => 'petugas1@admin.com',
            'password' => bcrypt('password'),
            'role' => 'PETUGAS',
            'counter_id' => $posPelayanan->id,
        ]);

        Service::create([
            'name' => 'Kartu Tanda Penduduk (KTP)',
            'code' => 'KTP',
            'description' => 'Layanan pengurusan e-KTP baru atau perbaikan.',
            'requirements' => "- Fotokopi KK\n- Surat Pengantar RT/RW",
            'procedure' => "1. Ambil antrian\n2. Menuju ruang pelayanan\n3. Perekaman data",
            'status' => true,
        ]);

        Service::create([
            'name' => 'Identitas Kependudukan Digital (IKD)',
            'code' => 'IKD',
            'description' => 'Layanan aktivasi IKD.',
            'requirements' => "- Smartphone\n- KTP Asli",
            'procedure' => "1. Ambil antrian\n2. Menuju ruang pelayanan\n3. Aktivasi aplikasi",
            'status' => true,
        ]);
    }
}
