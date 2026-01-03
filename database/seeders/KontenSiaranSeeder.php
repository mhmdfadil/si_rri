<?php

namespace Database\Seeders;

use App\Models\KontenSiaran;
use App\Models\KontenSiaranNarasumber;
use App\Models\Program;
use App\Models\Kategori;
use App\Models\Narasumber;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KontenSiaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data yang diperlukan
        $programs = Program::all();
        $kategoris = Kategori::all();
        $narasumbers = Narasumber::all();
        $users = User::all();

        // Pastikan ada data yang diperlukan
        if ($programs->isEmpty() || $kategoris->isEmpty() || $narasumbers->isEmpty() || $users->isEmpty()) {
            $this->command->error('Pastikan data Program, Kategori, Narasumber, dan User sudah ada!');
            return;
        }

        $this->command->info('Membuat data Konten Siaran...');

        // Data konten siaran untuk minggu ini
        $kontenSiarans = [
            // Hari ini - Live
            [
                'kode_konten' => 'KS-' . now()->format('Ymd') . '-001',
                'judul' => 'Dialog Pagi: Ekonomi Kerakyatan di Era Digital',
                'program_id' => $programs->random()->id,
                'kategori_id' => $kategoris->random()->id,
                'tanggal_siaran' => today(),
                'jam_siaran' => '08:00:00',
                'durasi' => 60,
                'segmen' => 'Pagi',
                'tipe_siaran' => 'live',
                'jenis_konten' => 'dialog',
                'studio' => 'Studio 1',
                'produser' => 'Budi Santoso',
                'penyiar' => 'Dewi Lestari',
                'operator' => 'Ahmad Fauzi',
                'deskripsi' => 'Diskusi mendalam tentang perkembangan ekonomi kerakyatan di tengah transformasi digital.',
                'topik_bahasan' => 'Ekonomi Digital, UMKM, Fintech, E-commerce',
                'rundown' => '08:00 - Opening
08:05 - Perkenalan Narasumber
08:10 - Sesi 1: Tantangan UMKM
08:25 - Sesi 2: Solusi Digital
08:40 - Tanya Jawab Pendengar
08:55 - Closing',
                'hashtag' => '#DialogPagi #EkonomiDigital',
                'kata_kunci' => 'ekonomi, UMKM, digital, fintech',
                'status' => 'siap_tayang',
                'diajukan_oleh' => $users->random()->id,
                'disetujui_oleh' => $users->random()->id,
                'tanggal_diajukan' => now()->subDays(3),
                'tanggal_disetujui' => now()->subDays(2),
                'dapat_diulang' => true,
            ],
            
            // Hari ini - Tayang
            [
                'kode_konten' => 'KS-' . now()->format('Ymd') . '-002',
                'judul' => 'Berita Siang: Update Terkini',
                'program_id' => $programs->random()->id,
                'kategori_id' => $kategoris->random()->id,
                'tanggal_siaran' => today(),
                'jam_siaran' => '12:00:00',
                'durasi' => 30,
                'segmen' => 'Siang',
                'tipe_siaran' => 'live',
                'jenis_konten' => 'berita',
                'studio' => 'Studio Berita',
                'produser' => 'Siti Nurhaliza',
                'penyiar' => 'Andi Prasetyo',
                'operator' => 'Rudi Hermawan',
                'deskripsi' => 'Berita terkini dari berbagai daerah dan nasional.',
                'topik_bahasan' => 'Politik, Ekonomi, Sosial, Budaya',
                'status' => 'tayang',
                'diajukan_oleh' => $users->random()->id,
                'disetujui_oleh' => $users->random()->id,
                'tanggal_diajukan' => now()->subDays(2),
                'tanggal_disetujui' => now()->subDays(1),
                'dapat_diulang' => false,
                'jumlah_pendengar' => 15420,
            ],

            // Besok
            [
                'kode_konten' => 'KS-' . now()->addDay()->format('Ymd') . '-001',
                'judul' => 'Talkshow Kesehatan: Hidup Sehat Ala Milenial',
                'program_id' => $programs->random()->id,
                'kategori_id' => $kategoris->random()->id,
                'tanggal_siaran' => today()->addDay(),
                'jam_siaran' => '10:00:00',
                'durasi' => 90,
                'segmen' => 'Pagi',
                'tipe_siaran' => 'live',
                'jenis_konten' => 'talkshow',
                'studio' => 'Studio 2',
                'produser' => 'Maya Sari',
                'penyiar' => 'Dr. Fitria Andini',
                'operator' => 'Bambang Susilo',
                'deskripsi' => 'Tips dan trik hidup sehat untuk generasi milenial yang sibuk.',
                'topik_bahasan' => 'Kesehatan, Gaya Hidup, Nutrisi, Olahraga',
                'rundown' => '10:00 - Opening
10:05 - Perkenalan
10:15 - Sesi 1: Pola Makan Sehat
10:35 - Sesi 2: Olahraga Efektif
10:55 - Sesi 3: Mental Health
11:15 - Q&A
11:25 - Closing',
                'hashtag' => '#HidupSehat #Milenial',
                'kata_kunci' => 'kesehatan, milenial, olahraga, nutrisi',
                'status' => 'disetujui',
                'diajukan_oleh' => $users->random()->id,
                'disetujui_oleh' => $users->random()->id,
                'tanggal_diajukan' => now()->subDays(5),
                'tanggal_disetujui' => now()->subDays(4),
                'dapat_diulang' => true,
            ],

            // Minggu depan - Rekaman
            [
                'kode_konten' => 'KS-' . now()->addDays(7)->format('Ymd') . '-001',
                'judul' => 'Feature Budaya: Warisan Leluhur Nusantara',
                'program_id' => $programs->random()->id,
                'kategori_id' => $kategoris->random()->id,
                'tanggal_siaran' => today()->addDays(7),
                'jam_siaran' => '15:00:00',
                'durasi' => 45,
                'segmen' => 'Sore',
                'tipe_siaran' => 'rekaman',
                'jenis_konten' => 'feature',
                'studio' => 'Studio Produksi',
                'produser' => 'Rahmat Hidayat',
                'penyiar' => 'Putri Maharani',
                'operator' => 'Agus Setiawan',
                'deskripsi' => 'Menyelami kekayaan budaya dan tradisi Nusantara yang masih lestari.',
                'topik_bahasan' => 'Budaya, Tradisi, Warisan, Nusantara',
                'file_audio' => 'audio/konten/feature-budaya-001.mp3',
                'hashtag' => '#WarisanNusantara #Budaya',
                'kata_kunci' => 'budaya, tradisi, nusantara, warisan',
                'status' => 'siap_tayang',
                'diajukan_oleh' => $users->random()->id,
                'disetujui_oleh' => $users->random()->id,
                'tanggal_diajukan' => now()->subDays(10),
                'tanggal_disetujui' => now()->subDays(9),
                'dapat_diulang' => true,
            ],

            // Draft
            [
                'kode_konten' => 'KS-' . now()->addDays(14)->format('Ymd') . '-001',
                'judul' => 'Wawancara Eksklusif: Perjalanan Karir Seniman Muda',
                'program_id' => $programs->random()->id,
                'kategori_id' => $kategoris->random()->id,
                'tanggal_siaran' => today()->addDays(14),
                'jam_siaran' => '20:00:00',
                'durasi' => 60,
                'segmen' => 'Malam',
                'tipe_siaran' => 'live',
                'jenis_konten' => 'wawancara',
                'studio' => 'Studio 1',
                'produser' => 'Rina Kusuma',
                'penyiar' => 'Joko Widodo',
                'deskripsi' => 'Wawancara mendalam dengan seniman muda berbakat tentang perjalanan karir mereka.',
                'topik_bahasan' => 'Seni, Karir, Inspirasi, Kreativitas',
                'status' => 'draft',
                'dapat_diulang' => true,
            ],

            // Diajukan
            [
                'kode_konten' => 'KS-' . now()->addDays(10)->format('Ymd') . '-001',
                'judul' => 'Dialog Pendidikan: Sistem Pembelajaran Digital',
                'program_id' => $programs->random()->id,
                'kategori_id' => $kategoris->random()->id,
                'tanggal_siaran' => today()->addDays(10),
                'jam_siaran' => '09:00:00',
                'durasi' => 75,
                'segmen' => 'Pagi',
                'tipe_siaran' => 'live',
                'jenis_konten' => 'dialog',
                'studio' => 'Studio 2',
                'produser' => 'Tono Sumarno',
                'penyiar' => 'Lisa Amelia',
                'operator' => 'Fajar Nugroho',
                'deskripsi' => 'Membahas perkembangan sistem pembelajaran digital di Indonesia.',
                'topik_bahasan' => 'Pendidikan, Digital, E-learning, Teknologi',
                'hashtag' => '#PendidikanDigital #Elearning',
                'kata_kunci' => 'pendidikan, digital, teknologi, pembelajaran',
                'status' => 'diajukan',
                'diajukan_oleh' => $users->random()->id,
                'tanggal_diajukan' => now()->subDays(1),
                'dapat_diulang' => true,
            ],

            // Selesai (kemarin)
            [
                'kode_konten' => 'KS-' . now()->subDay()->format('Ymd') . '-001',
                'judul' => 'Musik Nusantara: Melodi dari Timur',
                'program_id' => $programs->random()->id,
                'kategori_id' => $kategoris->random()->id,
                'tanggal_siaran' => today()->subDay(),
                'jam_siaran' => '19:00:00',
                'durasi' => 120,
                'segmen' => 'Malam',
                'tipe_siaran' => 'live',
                'jenis_konten' => 'musik',
                'studio' => 'Studio Musik',
                'produser' => 'Yanto Basuki',
                'penyiar' => 'Dina Mariana',
                'operator' => 'Hendra Gunawan',
                'deskripsi' => 'Menampilkan musik tradisional dari Indonesia Timur.',
                'topik_bahasan' => 'Musik, Tradisional, Nusantara, Budaya',
                'file_audio' => 'audio/konten/musik-nusantara-001.mp3',
                'hashtag' => '#MusikNusantara #Tradisional',
                'kata_kunci' => 'musik, tradisional, nusantara',
                'status' => 'selesai',
                'diajukan_oleh' => $users->random()->id,
                'disetujui_oleh' => $users->random()->id,
                'tanggal_diajukan' => now()->subDays(7),
                'tanggal_disetujui' => now()->subDays(6),
                'dapat_diulang' => true,
                'arsip' => true,
                'nomor_arsip' => 'ARS-001-' . now()->subDay()->format('Ymd'),
                'jumlah_pendengar' => 23500,
                'rating' => 4.5,
            ],

            // Selesai (2 hari lalu)
            [
                'kode_konten' => 'KS-' . now()->subDays(2)->format('Ymd') . '-001',
                'judul' => 'Talkshow Teknologi: AI dan Masa Depan',
                'program_id' => $programs->random()->id,
                'kategori_id' => $kategoris->random()->id,
                'tanggal_siaran' => today()->subDays(2),
                'jam_siaran' => '14:00:00',
                'durasi' => 60,
                'segmen' => 'Siang',
                'tipe_siaran' => 'live',
                'jenis_konten' => 'talkshow',
                'studio' => 'Studio 1',
                'produser' => 'Indra Gunawan',
                'penyiar' => 'Rani Puspita',
                'operator' => 'Dedi Kurniawan',
                'deskripsi' => 'Membahas perkembangan AI dan dampaknya terhadap berbagai sektor.',
                'topik_bahasan' => 'Teknologi, AI, Kecerdasan Buatan, Digital',
                'hashtag' => '#TeknologiAI #MasaDepan',
                'kata_kunci' => 'AI, teknologi, kecerdasan buatan, digital',
                'status' => 'selesai',
                'diajukan_oleh' => $users->random()->id,
                'disetujui_oleh' => $users->random()->id,
                'tanggal_diajukan' => now()->subDays(8),
                'tanggal_disetujui' => now()->subDays(7),
                'dapat_diulang' => true,
                'arsip' => true,
                'nomor_arsip' => 'ARS-002-' . now()->subDays(2)->format('Ymd'),
                'jumlah_pendengar' => 18900,
                'rating' => 4.7,
            ],
        ];

        // Insert data konten siaran
        $insertedKonten = [];
        foreach ($kontenSiarans as $konten) {
            $insertedKonten[] = KontenSiaran::create($konten);
            $this->command->info('✓ Konten: ' . $konten['judul']);
        }

        $this->command->info('Menambahkan narasumber ke konten siaran...');

        // Tambahkan narasumber ke setiap konten (1 sampai jumlah narasumber yang tersedia)
        foreach ($insertedKonten as $konten) {
            $maxNarasumber = min($narasumbers->count(), 4); // Maksimal 4 atau jumlah yang tersedia
            $jumlahNarasumber = rand(1, $maxNarasumber);
            $selectedNarasumbers = $narasumbers->random($jumlahNarasumber);
            
            foreach ($selectedNarasumbers as $index => $narasumber) {
                // Narasumber pertama sebagai narasumber utama
                $peran = $index === 0 ? 'narasumber_utama' : 
                         collect(['narasumber_pendamping', 'tamu_khusus', 'pakar', 'komentator'])->random();
                
                $durasiTampil = $index === 0 ? 
                    rand(30, 45) : // Narasumber utama lebih lama
                    rand(15, 30);  // Narasumber lainnya
                
                $honor = $index === 0 ?
                    rand(1500000, 3000000) : // Honor narasumber utama lebih besar
                    rand(500000, 1500000);   // Honor narasumber lainnya

                KontenSiaranNarasumber::create([
                    'konten_siaran_id' => $konten->id,
                    'narasumber_id' => $narasumber->id,
                    'peran' => $peran,
                    'durasi_tampil' => $durasiTampil,
                    'honor' => $honor,
                    'catatan' => $index === 0 ? 'Narasumber utama dengan expertise tinggi' : null,
                ]);
            }
            
            $this->command->info('  → Ditambahkan ' . $jumlahNarasumber . ' narasumber');
        }

        $this->command->info('');
        $this->command->info('✅ Seeder Konten Siaran selesai!');
        $this->command->info('Total konten: ' . count($insertedKonten));
        $this->command->info('');
        $this->command->table(
            ['Status', 'Jumlah'],
            [
                ['Draft', KontenSiaran::draft()->count()],
                ['Diajukan', KontenSiaran::diajukan()->count()],
                ['Disetujui', KontenSiaran::disetujui()->count()],
                ['Siap Tayang', KontenSiaran::siapTayang()->count()],
                ['Tayang', KontenSiaran::tayang()->count()],
                ['Selesai', KontenSiaran::selesai()->count()],
            ]
        );
    }
}