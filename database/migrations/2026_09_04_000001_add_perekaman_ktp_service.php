<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tambah layanan Perekaman KTP untuk deployment existing.
     * Idempotent: pakai firstOrCreate via DB agar tidak duplikat jika sudah ada.
     */
    public function up(): void
    {
        $exists = DB::table('services')->where('code', 'REKAM')->exists();

        if (! $exists) {
            DB::table('services')->insert([
                'name' => 'Perekaman KTP',
                'code' => 'REKAM',
                'description' => 'Layanan perekaman data e-KTP (foto, sidik jari, tanda tangan).',
                'requirements' => "- Fotokopi KK\n- Surat Pengantar RT/RW\n- Dokumen pendukung (jika ada)",
                'procedure' => "1. Ambil antrian Perekaman KTP\n2. Menuju ruang perekaman\n3. Verifikasi dokumen & perekaman biometrik",
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('services')->where('code', 'REKAM')->delete();
    }
};
