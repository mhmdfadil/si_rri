<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Kategori;
use App\Models\Narasumber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Ambil data kategori yang sudah ada
        $kategoriTeknologi = Kategori::where('nama_kategori', 'LIKE', '%Teknologi%')->first();
        $kategoriBisnis = Kategori::where('nama_kategori', 'LIKE', '%Bisnis%')->first();
        $kategoriPendidikan = Kategori::where('nama_kategori', 'LIKE', '%Pendidikan%')->first();

        // Ambil data narasumber yang sudah ada
        $narasumber1 = Narasumber::where('kode_narasumber', 'NRS-RRIL-00001')->first();
        $narasumber2 = Narasumber::where('kode_narasumber', 'NRS-RRIL-00002')->first();

        $programs = [
            [
                'kode_program' => 'PRG-00001',
                'nama_program' => 'Digital Transformation Workshop 2024',
                'kategori_id' => $kategoriTeknologi->id,
                'durasi' => 180, // 3 jam
                'deskripsi' => 'Workshop intensif tentang transformasi digital untuk perusahaan menengah dan besar. Membahas strategi implementasi teknologi terkini, cloud computing, dan analisis data untuk optimasi bisnis.',
                'status' => 'aktif',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(5),
            ],
            [
                'kode_program' => 'PRG-00002',
                'nama_program' => 'Webinar: Startup Funding & Investment Strategy',
                'kategori_id' => $kategoriBisnis->id,
                'durasi' => 120, // 2 jam
                'deskripsi' => 'Webinar khusus untuk para founder startup yang ingin memahami strategi pendanaan, pitch deck yang efektif, dan cara menarik investor venture capital. Disertai studi kasus startup unicorn Indonesia.',
                'status' => 'selesai',
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(15),
            ],
            [
                'kode_program' => 'PRG-00003',
                'nama_program' => 'Pelatihan Dosen: Metode Pembelajaran Hybrid',
                'kategori_id' => $kategoriPendidikan->id,
                'durasi' => 240, // 4 jam
                'deskripsi' => 'Pelatihan bagi dosen dan pengajar dalam mengimplementasikan metode pembelajaran hybrid yang efektif. Materi mencakup desain kurikulum digital, platform pembelajaran, dan assessment online.',
                'status' => 'draft',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(1),
            ],
        ];

        // Insert data program
        foreach ($programs as $programData) {
            $program = Program::create($programData);
        }

        $this->command->info('✅ Berhasil menambahkan 3 data program!');
        $this->command->info('');
    }
}