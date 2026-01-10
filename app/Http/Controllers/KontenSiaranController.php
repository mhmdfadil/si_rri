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

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'tanggal_siaran' => 'required|date',
            'jam_siaran' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:1',
            'tipe_siaran' => 'required|in:live,rekaman,tunda',
            'jenis_konten' => 'required|string',
            'deskripsi' => 'nullable|string',
            'topik_bahasan' => 'nullable|string',
            'studio' => 'nullable|string|max:100',
            'produser' => 'nullable|string|max:100',
            'penyiar' => 'nullable|string|max:100',
            'operator' => 'nullable|string|max:100',
            'rundown' => 'nullable|string',
            'naskah' => 'nullable|string',
            'catatan_produksi' => 'nullable|string',
            'hashtag' => 'nullable|string',
            'kata_kunci' => 'nullable|string',
            'status' => 'required|in:draft,diajukan,siap_tayang',
            'dapat_diulang' => 'nullable|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'narasumber_ids' => 'nullable|array',
            'narasumber_ids.*' => 'exists:narasumbers,id',
        ]);

        // Generate kode konten otomatis
        $validated['kode_konten'] = $this->generateKodeKonten();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('konten-siaran/thumbnails', 'public');
        }

        // Gabungkan tanggal dan jam
        $validated['jam_siaran'] = Carbon::parse($validated['tanggal_siaran'] . ' ' . $validated['jam_siaran']);

        // Set user yang mengajukan jika status diajukan
        if ($validated['status'] === 'diajukan') {
            $validated['diajukan_oleh'] = auth()->id();
            $validated['tanggal_diajukan'] = now();
        }

        $kontenSiaran = KontenSiaran::create($validated);

        // Attach narasumber jika ada
        if ($request->filled('narasumber_ids')) {
            $kontenSiaran->narasumbers()->attach($request->narasumber_ids);
        }

        return redirect()->route('konten-siaran.show', $kontenSiaran)
                        ->with('success', 'Konten siaran berhasil dibuat dengan kode: ' . $kontenSiaran->kode_konten);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KontenSiaran $kontenSiaran)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'tanggal_siaran' => 'required|date',
            'jam_siaran' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:1',
            'tipe_siaran' => 'required|in:live,rekaman,tunda',
            'jenis_konten' => 'required|string',
            'deskripsi' => 'nullable|string',
            'topik_bahasan' => 'nullable|string',
            'studio' => 'nullable|string|max:100',
            'produser' => 'nullable|string|max:100',
            'penyiar' => 'nullable|string|max:100',
            'operator' => 'nullable|string|max:100',
            'rundown' => 'nullable|string',
            'naskah' => 'nullable|string',
            'catatan_produksi' => 'nullable|string',
            'hashtag' => 'nullable|string',
            'kata_kunci' => 'nullable|string',
            'dapat_diulang' => 'nullable|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($kontenSiaran->thumbnail && !filter_var($kontenSiaran->thumbnail, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($kontenSiaran->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('konten-siaran/thumbnails', 'public');
        }

        // Gabungkan tanggal dan jam
        $validated['jam_siaran'] = Carbon::parse($validated['tanggal_siaran'] . ' ' . $validated['jam_siaran']);

        $kontenSiaran->update($validated);

        return redirect()->route('konten-siaran.show', $kontenSiaran)
                        ->with('success', 'Konten siaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KontenSiaran $kontenSiaran)
    {
        // Hapus thumbnail jika ada
        if ($kontenSiaran->thumbnail && !filter_var($kontenSiaran->thumbnail, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($kontenSiaran->thumbnail);
        }

        $kontenSiaran->delete();

        return redirect()->route('konten-siaran.index')
                        ->with('success', 'Konten siaran berhasil dihapus');
    }

    /**
     * Manage narasumber untuk konten siaran
     */
    public function manageNarasumber(KontenSiaran $kontenSiaran)
    {
        $kontenSiaran->load(['narasumbers', 'program']);
        $narasumbers = Narasumber::aktif()->orderBy('nama_lengkap')->get();

        return view('pages.konten-siaran.manage-narasumber', compact('kontenSiaran', 'narasumbers'));
    }

    /**
     * Store narasumber ke konten siaran
     */
    public function storeNarasumber(Request $request, KontenSiaran $kontenSiaran)
    {
        $validated = $request->validate([
            'narasumber_id' => 'required|exists:narasumbers,id',
            'peran' => 'required|string',
            'durasi_tampil' => 'nullable|integer|min:1',
            'honor' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        // Check if narasumber already exists
        if ($kontenSiaran->narasumbers()->where('narasumber_id', $validated['narasumber_id'])->exists()) {
            return back()->with('error', 'Narasumber sudah ditambahkan ke konten ini');
        }

        $kontenSiaran->narasumbers()->attach($validated['narasumber_id'], [
            'peran' => $validated['peran'],
            'durasi_tampil' => $validated['durasi_tampil'] ?? null,
            'honor' => $validated['honor'] ?? 0,
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return back()->with('success', 'Narasumber berhasil ditambahkan');
    }

    /**
     * Remove narasumber dari konten siaran
     */
    public function removeNarasumber(KontenSiaran $kontenSiaran, Narasumber $narasumber)
    {
        $kontenSiaran->narasumbers()->detach($narasumber->id);

        return back()->with('success', 'Narasumber berhasil dihapus');
    }

    /**
     * Workflow: Ajukan konten
     */
    public function ajukan(KontenSiaran $kontenSiaran)
    {
        if (!in_array($kontenSiaran->status, ['draft', 'ditolak'])) {
            return back()->with('error', 'Konten tidak dapat diajukan');
        }

        $kontenSiaran->ajukan();

        return back()->with('success', 'Konten berhasil diajukan untuk persetujuan');
    }

    /**
     * Workflow: Setujui konten
     */
    public function setujui(Request $request, KontenSiaran $kontenSiaran)
    {
        if ($kontenSiaran->status !== 'diajukan') {
            return back()->with('error', 'Konten tidak dapat disetujui');
        }

        $kontenSiaran->setujui(auth()->id(), $request->catatan_approval);

        return back()->with('success', 'Konten berhasil disetujui');
    }

    /**
     * Workflow: Tolak konten
     */
    public function tolak(Request $request, KontenSiaran $kontenSiaran)
    {
        $validated = $request->validate([
            'catatan_approval' => 'required|string',
        ]);

        if ($kontenSiaran->status !== 'diajukan') {
            return back()->with('error', 'Konten tidak dapat ditolak');
        }

        $kontenSiaran->tolak($validated['catatan_approval']);

        return back()->with('success', 'Konten ditolak');
    }

    /**
     * Workflow: Siapkan tayang
     */
    public function siapkanTayang(KontenSiaran $kontenSiaran)
    {
        if (!in_array($kontenSiaran->status, ['disetujui', 'draft'])) {
            return back()->with('error', 'Konten tidak dapat disiapkan tayang');
        }

        $kontenSiaran->siapkanTayang();

        return back()->with('success', 'Konten siap untuk ditayangkan');
    }

    /**
     * Workflow: Mulai tayang
     */
    public function mulaiTayang(KontenSiaran $kontenSiaran)
    {
        if ($kontenSiaran->status !== 'siap_tayang') {
            return back()->with('error', 'Konten tidak dapat ditayangkan');
        }

        $kontenSiaran->mulaiTayang();

        return back()->with('success', 'Konten sedang tayang');
    }

    /**
     * Workflow: Selesai tayang
     */
    public function selesaiTayang(KontenSiaran $kontenSiaran)
    {
        if ($kontenSiaran->status !== 'tayang') {
            return back()->with('error', 'Konten tidak sedang tayang');
        }

        $kontenSiaran->selesaiTayang();

        return back()->with('success', 'Konten selesai tayang');
    }

    /**
     * Workflow: Batalkan
     */
    public function batalkan(KontenSiaran $kontenSiaran)
    {
        if (in_array($kontenSiaran->status, ['tayang', 'selesai'])) {
            return back()->with('error', 'Konten tidak dapat dibatalkan');
        }

        $kontenSiaran->batalkan();

        return back()->with('success', 'Konten dibatalkan');
    }

    /**
     * Workflow: Arsipkan
     */
    public function arsipkan(Request $request, KontenSiaran $kontenSiaran)
    {
        if ($kontenSiaran->status !== 'selesai') {
            return back()->with('error', 'Hanya konten selesai yang dapat diarsipkan');
        }

        $kontenSiaran->arsipkan($request->nomor_arsip);

        return back()->with('success', 'Konten berhasil diarsipkan');
    }

    /**
     * Generate kode konten otomatis
     */
    private function generateKodeKonten()
    {
        $year = date('Y');
        $prefix = 'KNSR' . $year;

        // Get last kode konten for current year
        $lastKonten = KontenSiaran::where('kode_konten', 'like', $prefix . '%')
                                  ->orderBy('kode_konten', 'desc')
                                  ->first();

        if ($lastKonten) {
            // Extract number from last kode
            $lastNumber = (int) substr($lastKonten->kode_konten, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
    
}