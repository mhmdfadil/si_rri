<?php

namespace Database\Seeders;

use App\Models\Narasumber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NarasumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data sebelumnya jika ada
        Narasumber::query()->delete();

        $narasumbers = [
            [
                'kode_narasumber' => 'NRS20260001',
                'nama_lengkap' => 'Dr. Ahmad Wijaya',
                'gelar_depan' => 'Dr.',
                'gelar_belakang' => 'S.Kom, M.Kom',
                'instansi' => 'Universitas Indonesia',
                'jabatan_instansi' => 'Dosen Fakultas Ilmu Komputer',
                'bidang_keahlian' => 'Artificial Intelligence, Data Science',
                'email' => 'ahmad.wijaya@ui.ac.id',
                'telepon_kantor' => '021-7861234',
                'telepon_pribadi' => '081234567890',
                'whatsapp' => '081234567890',
                'telegram' => '@ahmadwijaya',
                'alamat' => 'Jl. Merdeka No. 123',
                'kelurahan' => 'Menteng',
                'kecamatan' => 'Menteng',
                'kota' => 'Jakarta Pusat',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '10310',
                'tanggal_lahir' => '1980-05-15',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Jakarta',
                'pendidikan_terakhir' => 'S3',
                'universitas' => 'University of Tokyo',
                'linkedin' => 'https://linkedin.com/in/ahmadwijaya',
                'facebook' => 'https://facebook.com/ahmad.wijaya',
                'instagram' => 'https://instagram.com/ahmadwijaya',
                'twitter' => 'https://twitter.com/ahmadwijaya',
                'status' => 'aktif',
                'catatan_khusus' => 'Ahli dalam bidang Machine Learning dan Deep Learning. Sering diundang sebagai pembicara di konferensi internasional.',
                'foto_profil' => 'https://randomuser.me/api/portraits/men/32.jpg',
            ],
            [
                'kode_narasumber' => 'NRS20260002',
                'nama_lengkap' => 'Prof. Siti Nurhaliza',
                'gelar_depan' => 'Prof.',
                'gelar_belakang' => 'Ph.D',
                'instansi' => 'Institut Teknologi Bandung',
                'jabatan_instansi' => 'Guru Besar Fakultas Ekonomi dan Bisnis',
                'bidang_keahlian' => 'Ekonomi Digital, Fintech',
                'email' => 'siti.nurhaliza@itb.ac.id',
                'telepon_kantor' => '022-2501234',
                'telepon_pribadi' => '081298765432',
                'whatsapp' => '081298765432',
                'telegram' => '@sitinurhaliza',
                'alamat' => 'Jl. Ganesha No. 10',
                'kelurahan' => 'Lebak Siliwangi',
                'kecamatan' => 'Coblong',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '40132',
                'tanggal_lahir' => '1975-08-22',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Bandung',
                'pendidikan_terakhir' => 'S3',
                'universitas' => 'Harvard University',
                'linkedin' => 'https://linkedin.com/in/sitinurhaliza',
                'facebook' => 'https://facebook.com/siti.nurhaliza',
                'instagram' => 'https://instagram.com/sitinurhaliza',
                'twitter' => 'https://twitter.com/sitinurhaliza',
                'status' => 'aktif',
                'catatan_khusus' => 'Pakar ekonomi digital dengan spesialisasi fintech dan blockchain. Pernah menjabat sebagai konsultan Bank Indonesia.',
                'foto_profil' => 'https://randomuser.me/api/portraits/women/44.jpg',
            ],
        ];

        foreach ($narasumbers as $narasumber) {
            Narasumber::create($narasumber);
        }

        $this->command->info('Berhasil menambahkan 2 data narasumber contoh!');
        $this->command->info('Narasumber 1: Dr. Ahmad Wijaya (NRS-RRIL-00001)');
        $this->command->info('Narasumber 2: Prof. Siti Nurhaliza (NRS-RRIL-00002)');
    }
}