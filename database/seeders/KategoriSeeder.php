<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Aktifkan kembali foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $kategoris = [
            [
                'kode_kategori' => 'KAT20260001',
                'nama_kategori' => 'Teknologi & Digital',
                'deskripsi' => 'Kategori untuk narasumber di bidang teknologi informasi, digital transformation, artificial intelligence, dan internet of things',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kategori' => 'KKAT20260002',
                'nama_kategori' => 'Bisnis & Ekonomi',
                'deskripsi' => 'Kategori untuk narasumber di bidang ekonomi makro, bisnis strategis, startup, fintech, dan investasi',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kategori' => 'KAT20260003',
                'nama_kategori' => 'Kesehatan & Medis',
                'deskripsi' => 'Kategori untuk narasumber di bidang kesehatan masyarakat, kedokteran, farmasi, dan lifestyle kesehatan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kategori' => 'KAT20260004',
                'nama_kategori' => 'Pendidikan & Pengajaran',
                'deskripsi' => 'Kategori untuk narasumber di bidang pendidikan formal, informal, pelatihan, dan pengembangan SDM',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kategori' => 'KAT20260005',
                'nama_kategori' => 'Hukum & Regulasi',
                'deskripsi' => 'Kategori untuk narasumber di bidang hukum bisnis, hak kekayaan intelektual, regulasi pemerintah, dan compliance',
                'is_active' => false, // Contoh kategori nonaktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data menggunakan DB::table untuk menghindari observer jika sudah ada kode
        DB::table('kategoris')->insert($kategoris);

        $this->command->info('✅ Berhasil menambahkan 5 data kategori!');
        $this->command->info('');
        
        // Tampilkan data dalam tabel yang rapi
        $headers = ['No', 'Kode', 'Nama Kategori', 'Status', 'Deskripsi Singkat'];
        $rows = [];
        
        foreach ($kategoris as $index => $kategori) {
            $rows[] = [
                $index + 1,
                $kategori['kode_kategori'],
                $kategori['nama_kategori'],
                $kategori['is_active'] ? '🟢 Aktif' : '🔴 Nonaktif',
                substr($kategori['deskripsi'], 0, 50) . '...'
            ];
        }
        
        $this->command->table($headers, $rows);
        
        $this->command->info('');
        $this->command->info('📊 Statistik:');
        $this->command->info('   Total Kategori: ' . count($kategoris));
        $this->command->info('   Kategori Aktif: ' . collect($kategoris)->where('is_active', true)->count());
        $this->command->info('   Kategori Nonaktif: ' . collect($kategoris)->where('is_active', false)->count());
    }
}