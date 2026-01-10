<?php

// =============================================================================
// File: app/Exports/NarasumberExport.php
// =============================================================================

namespace App\Exports;

use App\Models\Narasumber;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NarasumberExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Narasumber::withCount('kontenSiarans');

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['bidang_keahlian'])) {
            $query->where('bidang_keahlian', 'like', '%' . $this->filters['bidang_keahlian'] . '%');
        }

        if (!empty($this->filters['instansi'])) {
            $query->where('instansi', 'like', '%' . $this->filters['instansi'] . '%');
        }

        return $query->orderBy('nama_lengkap')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Narasumber',
            'Nama Lengkap',
            'Gelar Depan',
            'Gelar Belakang',
            'Instansi',
            'Jabatan',
            'Bidang Keahlian',
            'Email',
            'Telepon',
            'WhatsApp',
            'Status',
            'Jumlah Konten',
        ];
    }

    public function map($narasumber): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $narasumber->kode_narasumber,
            $narasumber->nama_lengkap,
            $narasumber->gelar_depan ?? '-',
            $narasumber->gelar_belakang ?? '-',
            $narasumber->instansi ?? '-',
            $narasumber->jabatan_instansi ?? '-',
            $narasumber->bidang_keahlian ?? '-',
            $narasumber->email ?? '-',
            $narasumber->telepon_pribadi ?? '-',
            $narasumber->whatsapp ?? '-',
            ucfirst($narasumber->status),
            $narasumber->konten_siarans_count,
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
        return 'Laporan Narasumber';
    }
}