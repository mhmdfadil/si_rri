<?php

// =============================================================================
// File: app/Exports/KontenSiaranExport.php
// =============================================================================

namespace App\Exports;

use App\Models\KontenSiaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KontenSiaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = KontenSiaran::with(['program', 'kategori', 'narasumbers']);

        // Apply filters
        if (!empty($this->filters['tanggal_dari']) && !empty($this->filters['tanggal_sampai'])) {
            $query->whereBetween('tanggal_siaran', [$this->filters['tanggal_dari'], $this->filters['tanggal_sampai']]);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['program_id'])) {
            $query->where('program_id', $this->filters['program_id']);
        }

        if (!empty($this->filters['kategori_id'])) {
            $query->where('kategori_id', $this->filters['kategori_id']);
        }

        if (!empty($this->filters['tipe_siaran'])) {
            $query->where('tipe_siaran', $this->filters['tipe_siaran']);
        }

        return $query->orderBy('tanggal_siaran', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Konten',
            'Judul',
            'Program',
            'Kategori',
            'Tanggal Siaran',
            'Jam Siaran',
            'Durasi (Menit)',
            'Tipe Siaran',
            'Jenis Konten',
            'Narasumber',
            'Jumlah Narasumber',
            'Status',
            'Produser',
            'Penyiar',
            'Studio',
        ];
    }

    public function map($konten): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $konten->kode_konten,
            $konten->judul,
            $konten->program->nama_program ?? '-',
            $konten->kategori->nama_kategori ?? '-',
            $konten->tanggal_siaran->format('d/m/Y'),
            \Carbon\Carbon::parse($konten->jam_siaran)->format('H:i'),
            $konten->durasi,
            ucfirst($konten->tipe_siaran),
            $konten->jenis_konten_text,
            $konten->narasumbers->pluck('nama_lengkap')->join(', '),
            $konten->narasumbers->count(),
            $konten->status_text,
            $konten->produser ?? '-',
            $konten->penyiar ?? '-',
            $konten->studio ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Laporan Konten Siaran';
    }
}
