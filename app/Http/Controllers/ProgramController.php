<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Program::with('kategori');

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->byKategori($request->kategori_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = $request->get('sort_dir', 'desc');
        
        if ($sortBy === 'nama') {
            $query->orderByName($sortDir);
        } elseif ($sortBy === 'kode') {
            $query->orderByKode($sortDir);
        } elseif ($sortBy === 'durasi') {
            $query->orderByDurasi($sortDir);
        } else {
            $query->orderBy($sortBy, $sortDir);
        }

        $programs = $query->paginate(10)->withQueryString();

        // Get all categories for filter
        $kategoris = Kategori::active()->orderByName()->get();

        return view('pages.program.index', compact('programs', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::active()->orderByName()->get();
        return view('pages.program.create', compact('kategoris'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $program->load(['kategori', 'narasumbers']);
        return view('pages.program.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $kategoris = Kategori::active()->orderByName()->get();
        return view('pages.program.edit', compact('program', 'kategoris'));
    }
    
}