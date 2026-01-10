<?php

namespace App\Http\Controllers;

use App\Models\KontenSiaran;
use App\Models\Narasumber;
use App\Models\Program;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KontenSiaranExport;
use App\Exports\NarasumberExport;

class LaporanController extends Controller
{
    /**
     * Display laporan index
     */
    public function index()
    {
        return view('pages.laporan.index');
    }

    /**
     * Laporan Konten Siaran
     */
    public function kontenSiaran(Request $request)
    {
        $query = KontenSiaran::with(['program', 'kategori', 'narasumbers']);

        // Apply filters
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal_siaran', [$request->tanggal_dari, $request->tanggal_sampai]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('tipe_siaran')) {
            $query->where('tipe_siaran', $request->tipe_siaran);
        }

        $kontenSiaran = $query->orderBy('tanggal_siaran', 'desc')
                             ->orderBy('jam_siaran', 'desc')
                             ->get();

        // Get filters data
        $programs = Program::aktif()->orderBy('nama_program')->get();
        $kategoris = Kategori::active()->orderBy('nama_kategori')->get();

        // Calculate statistics
        $stats = [
            'total' => $kontenSiaran->count(),
            'total_durasi' => $kontenSiaran->sum('durasi'),
            'total_narasumber' => $kontenSiaran->sum(function($item) {
                return $item->narasumbers->count();
            }),
            'per_status' => $kontenSiaran->groupBy('status')->map->count(),
            'per_tipe' => $kontenSiaran->groupBy('tipe_siaran')->map->count(),
        ];

        return view('pages.laporan.konten-siaran', compact('kontenSiaran', 'programs', 'kategoris', 'stats'));
    }

    /**
     * Laporan Narasumber
     */
    public function narasumber(Request $request)
    {
        $query = Narasumber::withCount('kontenSiarans');

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('bidang_keahlian')) {
            $query->where('bidang_keahlian', 'like', '%' . $request->bidang_keahlian . '%');
        }

        if ($request->filled('instansi')) {
            $query->where('instansi', 'like', '%' . $request->instansi . '%');
        }

        $narasumbers = $query->orderBy('nama_lengkap')->get();

        // Calculate statistics
        $stats = [
            'total' => $narasumbers->count(),
            'total_aktif' => $narasumbers->where('status', 'aktif')->count(),
            'total_konten' => $narasumbers->sum('konten_siarans_count'),
            'per_status' => $narasumbers->groupBy('status')->map->count(),
        ];

        return view('pages.laporan.narasumber', compact('narasumbers', 'stats'));
    }

    /**
     * Laporan Program
     */
    public function program(Request $request)
    {
        $query = Program::withCount('kontenSiarans')->with('kategori');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $programs = $query->orderBy('nama_program')->get();

        $kategoris = Kategori::active()->orderBy('nama_kategori')->get();

        $stats = [
            'total' => $programs->count(),
            'total_aktif' => $programs->where('status', 'aktif')->count(),
            'total_konten' => $programs->sum('konten_siarans_count'),
        ];

        return view('pages.laporan.program', compact('programs', 'kategoris', 'stats'));
    }

    /**
     * Export Konten Siaran to Excel
     */
    public function exportKontenExcel(Request $request)
    {
        $filters = $request->only(['tanggal_dari', 'tanggal_sampai', 'status', 'program_id', 'kategori_id', 'tipe_siaran']);
        
        return Excel::download(new KontenSiaranExport($filters), 'laporan-konten-siaran-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Export Konten Siaran to PDF (Normal)
     */
    public function exportKontenPDF(Request $request)
    {
        $query = KontenSiaran::with(['program', 'kategori', 'narasumbers']);

        // Apply filters
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal_siaran', [$request->tanggal_dari, $request->tanggal_sampai]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('tipe_siaran')) {
            $query->where('tipe_siaran', $request->tipe_siaran);
        }

        $kontenSiaran = $query->orderBy('tanggal_siaran', 'desc')->get();

        $stats = [
            'total' => $kontenSiaran->count(),
            'total_durasi' => $kontenSiaran->sum('durasi'),
        ];

        $pdf = Pdf::loadView('pages.laporan.pdf.konten-siaran', compact('kontenSiaran', 'stats'));
        return $pdf->download('laporan-konten-siaran-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Export Konten Siaran to PDF dengan Kop Surat
     */
    public function exportKontenPDFKop(Request $request)
    {
        $query = KontenSiaran::with(['program', 'kategori', 'narasumbers']);

        // Apply filters
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal_siaran', [$request->tanggal_dari, $request->tanggal_sampai]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('tipe_siaran')) {
            $query->where('tipe_siaran', $request->tipe_siaran);
        }

        $kontenSiaran = $query->orderBy('tanggal_siaran', 'desc')->get();

        $stats = [
            'total' => $kontenSiaran->count(),
            'total_durasi' => $kontenSiaran->sum('durasi'),
        ];

        $filters = [
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'status' => $request->status,
        ];

        $pdf = Pdf::loadView('pages.laporan.pdf.konten-siaran-kop', compact('kontenSiaran', 'stats', 'filters'));
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->download('laporan-konten-siaran-kop-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Export Narasumber to Excel
     */
    public function exportNarasumberExcel(Request $request)
    {
        $filters = $request->only(['status', 'bidang_keahlian', 'instansi']);
        
        return Excel::download(new NarasumberExport($filters), 'laporan-narasumber-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Export Narasumber to PDF
     */
    public function exportNarasumberPDF(Request $request)
    {
        $query = Narasumber::withCount('kontenSiarans');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('bidang_keahlian')) {
            $query->where('bidang_keahlian', 'like', '%' . $request->bidang_keahlian . '%');
        }

        $narasumbers = $query->orderBy('nama_lengkap')->get();

        $stats = [
            'total' => $narasumbers->count(),
            'total_aktif' => $narasumbers->where('status', 'aktif')->count(),
        ];

        $pdf = Pdf::loadView('pages.laporan.pdf.narasumber', compact('narasumbers', 'stats'));
        return $pdf->download('laporan-narasumber-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Export Narasumber to PDF dengan Kop
     */
    public function exportNarasumberPDFKop(Request $request)
    {
        $query = Narasumber::withCount('kontenSiarans');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $narasumbers = $query->orderBy('nama_lengkap')->get();

        $stats = [
            'total' => $narasumbers->count(),
            'total_aktif' => $narasumbers->where('status', 'aktif')->count(),
        ];

        $pdf = Pdf::loadView('pages.laporan.pdf.narasumber-kop', compact('narasumbers', 'stats'));
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->download('laporan-narasumber-kop-' . date('Y-m-d') . '.pdf');
    }
}