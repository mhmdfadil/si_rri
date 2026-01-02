<?php

namespace App\Http\Controllers;

use App\Models\Narasumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NarasumberController extends Controller
{
    /**
     * Display a listing of the narasumber.
     */
    public function index(Request $request)
    {
        $query = Narasumber::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by bidang keahlian
        if ($request->has('bidang_keahlian') && $request->bidang_keahlian != '') {
            $query->where('bidang_keahlian', 'like', '%' . $request->bidang_keahlian . '%');
        }

        // Filter by kota
        if ($request->has('kota') && $request->kota != '') {
            $query->where('kota', $request->kota);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $narasumber = $query->paginate(15)->withQueryString();

        // Get unique bidang keahlian and kota for filters
        $bidangKeahlianList = Narasumber::distinct()->pluck('bidang_keahlian')->filter();
        $kotaList = Narasumber::distinct()->pluck('kota')->filter()->sort()->values();

        return view('pages.narasumber.index', compact('narasumber', 'bidangKeahlianList', 'kotaList'));
    }

    /**
     * Show the form for creating a new narasumber.
     */
    public function create()
    {
        return view('pages.narasumber.create');
    }

    /**
     * Display the specified narasumber.
     */
    public function show(Narasumber $narasumber)
    {
        return view('pages.narasumber.show', compact('narasumber'));
    }

    /**
     * Show the form for editing the specified narasumber.
     */
    public function edit(Narasumber $narasumber)
    {
        return view('pages.narasumber.edit', compact('narasumber'));
    }

     /**
     * Store a newly created narasumber in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:100',
            'instansi' => 'nullable|string|max:255',
            'jabatan_instansi' => 'nullable|string|max:255',
            'bidang_keahlian' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:narasumbers,email',
            'telepon_kantor' => 'nullable|string|max:20',
            'telepon_pribadi' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'universitas' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif,blacklist,pensiun',
            'catatan_khusus' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto_profil');
        
        // Generate kode narasumber otomatis
        $data['kode_narasumber'] = $this->generateKodeNarasumber();

        // Handle foto profil upload
        if ($request->hasFile('foto_profil')) {
            $fotoPath = $request->file('foto_profil')->store('narasumber-photos', 'public');
            $data['foto_profil'] = $fotoPath;
        }

        Narasumber::create($data);

        return redirect()->route('narasumber.index')
            ->with('success', 'Data narasumber berhasil ditambahkan!');
    }

    /**
     * Update the specified narasumber in storage.
     */
    public function update(Request $request, Narasumber $narasumber)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:100',
            'instansi' => 'nullable|string|max:255',
            'jabatan_instansi' => 'nullable|string|max:255',
            'bidang_keahlian' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:narasumbers,email,' . $narasumber->id,
            'telepon_kantor' => 'nullable|string|max:20',
            'telepon_pribadi' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'universitas' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif,blacklist,pensiun',
            'catatan_khusus' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto_profil');

        // Handle foto profil upload
        if ($request->hasFile('foto_profil')) {
            // Delete old photo
            if ($narasumber->foto_profil && Storage::disk('public')->exists($narasumber->foto_profil)) {
                Storage::disk('public')->delete($narasumber->foto_profil);
            }

            $fotoPath = $request->file('foto_profil')->store('narasumber-photos', 'public');
            $data['foto_profil'] = $fotoPath;
        }

        $narasumber->update($data);

        return redirect()->route('narasumber.index')
            ->with('success', 'Data narasumber berhasil diperbarui!');
    }

    /**
     * Remove the specified narasumber from storage.
     */
    public function destroy(Narasumber $narasumber)
    {
        // Delete foto if exists
        if ($narasumber->foto_profil && Storage::disk('public')->exists($narasumber->foto_profil)) {
            Storage::disk('public')->delete($narasumber->foto_profil);
        }

        $narasumber->delete();

        return redirect()->route('narasumber.index')
            ->with('success', 'Data narasumber berhasil dihapus!');
    }

    /**
     * Delete narasumber photo.
     */
    public function deletePhoto(Narasumber $narasumber)
    {
        if ($narasumber->foto_profil && Storage::disk('public')->exists($narasumber->foto_profil)) {
            Storage::disk('public')->delete($narasumber->foto_profil);
        }

        $narasumber->update(['foto_profil' => null]);

        return redirect()->back()
            ->with('success', 'Foto profil narasumber berhasil dihapus!');
    }

    /**
     * Generate unique kode narasumber
     */
    private function generateKodeNarasumber()
    {
        $prefix = 'NRS';
        $year = date('Y');
        
        // Get last narasumber of the year
        $lastNarasumber = Narasumber::where('kode_narasumber', 'like', $prefix . $year . '%')
            ->orderBy('kode_narasumber', 'desc')
            ->first();

        if ($lastNarasumber) {
            $lastNumber = intval(substr($lastNarasumber->kode_narasumber, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . $year . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Export narasumber to Excel/CSV
     */
    public function export(Request $request)
    {   
        return redirect()->back()
            ->with('info', 'Fitur export sedang dalam pengembangan.');
    }
}