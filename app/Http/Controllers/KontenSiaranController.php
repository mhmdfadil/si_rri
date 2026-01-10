<?php

namespace App\Http\Controllers;

use App\Models\KontenSiaran;
use App\Models\Program;
use App\Models\Kategori;
use App\Models\Narasumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KontenSiaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KontenSiaran::with(['program', 'kategori', 'narasumbers']);

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by program
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // Filter by tipe siaran
        if ($request->filled('tipe_siaran')) {
            $query->where('tipe_siaran', $request->tipe_siaran);
        }

        // Filter by tanggal
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->byRentangTanggal($request->tanggal_dari, $request->tanggal_sampai);
        } elseif ($request->filled('filter_tanggal')) {
            switch ($request->filter_tanggal) {
                case 'hari_ini':
                    $query->hariIni();
                    break;
                case 'besok':
                    $query->besok();
                    break;
                case 'minggu_ini':
                    $query->mingguIni();
                    break;
                case 'bulan_ini':
                    $query->bulanIni();
                    break;
            }
        }

        $kontenSiaran = $query->orderBy('tanggal_siaran', 'desc')
                             ->orderBy('jam_siaran', 'desc')
                             ->paginate(15);

        // Data untuk filter
        $programs = Program::aktif()->orderBy('nama_program')->get();

        return view('pages.konten-siaran.index', compact('kontenSiaran', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::aktif()->orderBy('nama_program')->get();
        $kategoris = Kategori::active()->orderBy('nama_kategori')->get();
        $narasumbers = Narasumber::aktif()->orderBy('nama_lengkap')->get();

        return view('pages.konten-siaran.create', compact('programs', 'kategoris', 'narasumbers'));
    }


    /**
     * Display the specified resource.
     */
    public function show(KontenSiaran $kontenSiaran)
    {
        $kontenSiaran->load(['program', 'kategori', 'narasumbers', 'pengaju', 'penyetuju']);
        
        return view('pages.konten-siaran.show', compact('kontenSiaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KontenSiaran $kontenSiaran)
    {
        $programs = Program::aktif()->orderBy('nama_program')->get();
        $kategoris = Kategori::active()->orderBy('nama_kategori')->get();
        $narasumbers = Narasumber::aktif()->orderBy('nama_lengkap')->get();

        return view('pages.konten-siaran.edit', compact('kontenSiaran', 'programs', 'kategoris', 'narasumbers'));
    }

}