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

}