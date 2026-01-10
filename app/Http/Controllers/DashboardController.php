<?php

namespace App\Http\Controllers;

use App\Models\KontenSiaran;
use App\Models\Narasumber;
use App\Models\Program;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display dashboard overview
     */
    public function index()
    {
        // Stats Cards
        $stats = [
            'total_konten' => KontenSiaran::count(),
            'total_narasumber' => Narasumber::count(),
            'total_program' => Program::count(),
            'total_kategori' => Kategori::count(),
            
            // Konten stats by status
            'konten_draft' => KontenSiaran::draft()->count(),
            'konten_diajukan' => KontenSiaran::diajukan()->count(),
            'konten_siap_tayang' => KontenSiaran::siapTayang()->count(),
            'konten_tayang' => KontenSiaran::tayang()->count(),
            'konten_selesai' => KontenSiaran::selesai()->count(),
            
            // Konten hari ini & minggu ini
            'konten_hari_ini' => KontenSiaran::hariIni()->count(),
            'konten_besok' => KontenSiaran::besok()->count(),
            'konten_minggu_ini' => KontenSiaran::mingguIni()->count(),
            'konten_bulan_ini' => KontenSiaran::bulanIni()->count(),
            
            // Narasumber aktif
            'narasumber_aktif' => Narasumber::aktif()->count(),
            
            // Program aktif
            'program_aktif' => Program::aktif()->count(),
        ];

        // Konten Hari Ini
        $kontenHariIni = KontenSiaran::with(['program', 'kategori', 'narasumbers'])
            ->hariIni()
            ->orderBy('jam_siaran', 'asc')
            ->limit(10)
            ->get();

        // Konten Upcoming (7 hari ke depan)
        $kontenUpcoming = KontenSiaran::with(['program', 'kategori', 'narasumbers'])
            ->where('tanggal_siaran', '>', today())
            ->where('tanggal_siaran', '<=', today()->addDays(7))
            ->whereIn('status', ['siap_tayang', 'disetujui'])
            ->orderBy('tanggal_siaran', 'asc')
            ->orderBy('jam_siaran', 'asc')
            ->limit(10)
            ->get();

        // Konten Butuh Persetujuan
        $kontenButuhPersetujuan = KontenSiaran::with(['program', 'kategori', 'pengaju'])
            ->diajukan()
            ->orderBy('tanggal_diajukan', 'desc')
            ->limit(5)
            ->get();

        // Narasumber Populer (berdasarkan jumlah konten)
        $narasumberPopuler = Narasumber::withCount('kontenSiarans')
            ->aktif()
            ->orderBy('konten_siarans_count', 'desc')
            ->limit(5)
            ->get();

        // Program Populer (berdasarkan jumlah konten)
        $programPopuler = Program::withCount('kontenSiarans')
            ->aktif()
            ->orderBy('konten_siarans_count', 'desc')
            ->limit(5)
            ->get();

        // Chart Data - Konten per Bulan (6 bulan terakhir)
        $kontenPerBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $kontenPerBulan[] = [
                'bulan' => $date->format('M Y'),
                'total' => KontenSiaran::whereYear('tanggal_siaran', $date->year)
                    ->whereMonth('tanggal_siaran', $date->month)
                    ->count(),
            ];
        }

        // Chart Data - Konten per Status
        $kontenPerStatus = [
            ['status' => 'Draft', 'total' => $stats['konten_draft']],
            ['status' => 'Diajukan', 'total' => $stats['konten_diajukan']],
            ['status' => 'Siap Tayang', 'total' => $stats['konten_siap_tayang']],
            ['status' => 'Tayang', 'total' => $stats['konten_tayang']],
            ['status' => 'Selesai', 'total' => $stats['konten_selesai']],
        ];

        // Chart Data - Konten per Tipe Siaran
        $kontenPerTipe = KontenSiaran::select('tipe_siaran', DB::raw('count(*) as total'))
            ->groupBy('tipe_siaran')
            ->get()
            ->map(function($item) {
                return [
                    'tipe' => ucfirst($item->tipe_siaran),
                    'total' => $item->total
                ];
            });

        // Chart Data - Konten per Kategori (Top 5)
        $kontenPerKategori = Kategori::withCount('kontenSiarans')
            ->orderBy('konten_siarans_count', 'desc')
            ->limit(5)
            ->get()
            ->map(function($kategori) {
                return [
                    'kategori' => $kategori->nama_kategori,
                    'total' => $kategori->konten_siarans_count
                ];
            });

        // Recent Activities (10 konten terbaru dibuat)
        $recentActivities = KontenSiaran::with(['program', 'pengaju'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('pages.dashboard', compact(
            'stats',
            'kontenHariIni',
            'kontenUpcoming',
            'kontenButuhPersetujuan',
            'narasumberPopuler',
            'programPopuler',
            'kontenPerBulan',
            'kontenPerStatus',
            'kontenPerTipe',
            'kontenPerKategori',
            'recentActivities'
        ));
    }

    /**
     * Get quick stats for AJAX
     */
    public function quickStats()
    {
        return response()->json([
            'konten_hari_ini' => KontenSiaran::hariIni()->count(),
            'konten_besok' => KontenSiaran::besok()->count(),
            'konten_butuh_persetujuan' => KontenSiaran::diajukan()->count(),
            'konten_sedang_tayang' => KontenSiaran::tayang()->count(),
        ]);
    }
}