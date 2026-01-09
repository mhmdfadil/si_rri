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

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'durasi' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_keys(Program::STATUS_OPTIONS)),
        ], [
            'nama_program.required' => 'Nama program wajib diisi',
            'nama_program.max' => 'Nama program maksimal 255 karakter',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'durasi.required' => 'Durasi wajib diisi',
            'durasi.integer' => 'Durasi harus berupa angka',
            'durasi.min' => 'Durasi minimal 1 menit',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        // Generate kode program otomatis
        $validated['kode_program'] = $this->generateKodeProgram();

        Program::create($validated);

        return redirect()
            ->route('program.index')
            ->with('success', 'Program berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'durasi' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_keys(Program::STATUS_OPTIONS)),
        ], [
            'nama_program.required' => 'Nama program wajib diisi',
            'nama_program.max' => 'Nama program maksimal 255 karakter',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'durasi.required' => 'Durasi wajib diisi',
            'durasi.integer' => 'Durasi harus berupa angka',
            'durasi.min' => 'Durasi minimal 1 menit',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        $program->update($validated);

        return redirect()
            ->route('program.show', $program)
            ->with('success', 'Program berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        try {
            $program->delete();

            return redirect()
                ->route('program.index')
                ->with('success', 'Program berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('program.index')
                ->with('error', 'Gagal menghapus program: ' . $e->getMessage());
        }
    }

    /**
     * Change program status
     */
    public function changeStatus(Request $request, Program $program)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Program::STATUS_OPTIONS)),
        ]);

        $program->update(['status' => $validated['status']]);

        return redirect()
            ->back()
            ->with('success', 'Status program berhasil diubah menjadi ' . Program::STATUS_OPTIONS[$validated['status']]);
    }

    /**
     * Generate kode program otomatis
     * Format: PRG + YYYY + 4 digit number (PRG20260001)
     */
    private function generateKodeProgram()
    {
        $year = date('Y');
        $prefix = 'PRG' . $year;

        // Get last program for current year
        $lastProgram = Program::withTrashed()
            ->where('kode_program', 'like', $prefix . '%')
            ->orderBy('kode_program', 'desc')
            ->first();

        if (!$lastProgram) {
            return $prefix . '0001';
        }

        // Extract number from last kode
        $lastNumber = (int) substr($lastProgram->kode_program, -4);
        $newNumber = $lastNumber + 1;

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}