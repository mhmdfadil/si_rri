<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kategori::query();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->active();
            } elseif ($request->status === 'nonaktif') {
                $query->inactive();
            }
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = $request->get('sort_dir', 'desc');
        
        if ($sortBy === 'nama') {
            $query->orderByName($sortDir);
        } elseif ($sortBy === 'kode') {
            $query->orderByKode($sortDir);
        } else {
            $query->orderBy($sortBy, $sortDir);
        }

        $kategoris = $query->paginate(10)->withQueryString();

        return view('pages.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kategori.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return view('pages.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('pages.kategori.edit', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter',
        ]);

        // Generate kode kategori otomatis
        $validated['kode_kategori'] = $this->generateKodeKategori();
        $validated['is_active'] = $request->has('is_active');

        Kategori::create($validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $kategori->update($validated);

        return redirect()
            ->route('kategori.show', $kategori)
            ->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();

            return redirect()
                ->route('kategori.index')
                ->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }

    /**
     * Toggle status kategori
     */
    public function toggleStatus(Kategori $kategori)
    {
        $kategori->toggleStatus();

        return redirect()
            ->back()
            ->with('success', 'Status kategori berhasil diubah');
    }

    /**
     * Generate kode kategori otomatis
     */
    private function generateKodeKategori()
    {
        // Get last kategori
        $lastKategori = Kategori::withTrashed()
            ->orderBy('kode_kategori', 'desc')
            ->first();

        if (!$lastKategori) {
            return 'KAT-00001';
        }

        // Extract number from last kode
        $lastNumber = (int) substr($lastKategori->kode_kategori, 4);
        $newNumber = $lastNumber + 1;

        return 'KAT-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }
}