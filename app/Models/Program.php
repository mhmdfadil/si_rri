<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'programs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_program',
        'nama_program',
        'kategori_id',
        'durasi',
        'deskripsi',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'durasi' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Status options untuk program
     */
    public const STATUS_OPTIONS = [
        'draft' => 'Draft',
        'aktif' => 'Aktif',
        'nonaktif' => 'Nonaktif',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];

    /**
     * Relasi ke model Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi ke model Narasumber (many-to-many)
     */
    public function narasumbers()
    {
        return $this->hasMany(Narasumber::class);
    }


    /**
     * Scope untuk program aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk program draft
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope untuk program selesai
     */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_program', 'like', "%{$search}%")
                    ->orWhere('kode_program', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function($q) use ($search) {
                        $q->where('nama_kategori', 'like', "%{$search}%");
                    });
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByKategori($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk urut berdasarkan nama
     */
    public function scopeOrderByName($query, $direction = 'asc')
    {
        return $query->orderBy('nama_program', $direction);
    }

    /**
     * Scope untuk urut berdasarkan kode
     */
    public function scopeOrderByKode($query, $direction = 'asc')
    {
        return $query->orderBy('kode_program', $direction);
    }

    /**
     * Scope untuk urut berdasarkan durasi
     */
    public function scopeOrderByDurasi($query, $direction = 'asc')
    {
        return $query->orderBy('durasi', $direction);
    }

    /**
     * Get status label dengan warna
     */
    public function getStatusLabelAttribute()
    {
        $colors = [
            'draft' => 'secondary',
            'aktif' => 'success',
            'nonaktif' => 'danger',
            'selesai' => 'info',
            'dibatalkan' => 'warning',
        ];

        $color = $colors[$this->status] ?? 'secondary';
        
        return '<span class="badge bg-' . $color . '">' . self::STATUS_OPTIONS[$this->status] . '</span>';
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        return self::STATUS_OPTIONS[$this->status] ?? $this->status;
    }

    /**
     * Get durasi dalam format jam:menit
     */
    public function getDurasiFormattedAttribute()
    {
        if ($this->durasi < 60) {
            return $this->durasi . ' menit';
        }
        
        $jam = floor($this->durasi / 60);
        $menit = $this->durasi % 60;
        
        if ($menit == 0) {
            return $jam . ' jam';
        }
        
        return $jam . ' jam ' . $menit . ' menit';
    }

    /**
     * Get nama program dengan kode
     */
    public function getNamaWithKodeAttribute()
    {
        return "{$this->kode_program} - {$this->nama_program}";
    }

    /**
     * Get nama kategori
     */
    public function getNamaKategoriAttribute()
    {
        return $this->kategori ? $this->kategori->nama_kategori : '-';
    }

    /**
     * Get kode kategori
     */
    public function getKodeKategoriAttribute()
    {
        return $this->kategori ? $this->kategori->kode_kategori : '-';
    }

    /**
     * Check if program is draft
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Check if program is aktif
     */
    public function isAktif(): bool
    {
        return $this->status === 'aktif';
    }

    /**
     * Check if program is selesai
     */
    public function isSelesai(): bool
    {
        return $this->status === 'selesai';
    }

    /**
     * Check if program is dibatalkan
     */
    public function isDibatalkan(): bool
    {
        return $this->status === 'dibatalkan';
    }

    /**
     * Activate program
     */
    public function activate(): bool
    {
        return $this->update(['status' => 'aktif']);
    }

    /**
     * Deactivate program
     */
    public function deactivate(): bool
    {
        return $this->update(['status' => 'nonaktif']);
    }

    /**
     * Mark as selesai
     */
    public function markAsSelesai(): bool
    {
        return $this->update(['status' => 'selesai']);
    }

    /**
     * Mark as dibatalkan
     */
    public function markAsDibatalkan(): bool
    {
        return $this->update(['status' => 'dibatalkan']);
    }

    /**
     * Get deskripsi singkat
     */
    public function getDeskripsiSingkatAttribute()
    {
        if (!$this->deskripsi) {
            return '-';
        }

        $limit = 100;
        if (strlen($this->deskripsi) <= $limit) {
            return $this->deskripsi;
        }

        return substr($this->deskripsi, 0, $limit) . '...';
    }

    /**
     * Count jumlah narasumber dalam program
     */
    public function countNarasumbers()
    {
        return $this->narasumbers()->count();
    }

    /**
     * Get honor total untuk semua narasumber
     */
    public function getTotalHonorAttribute()
    {
        return $this->narasumbers()->sum('honor');
    }
}