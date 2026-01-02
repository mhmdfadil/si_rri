<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'kategoris';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'deskripsi',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Scope untuk kategori aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk kategori nonaktif
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_kategori', 'like', "%{$search}%")
                    ->orWhere('kode_kategori', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
    }

    /**
     * Scope untuk urut berdasarkan nama
     */
    public function scopeOrderByName($query, $direction = 'asc')
    {
        return $query->orderBy('nama_kategori', $direction);
    }

    /**
     * Scope untuk urut berdasarkan kode
     */
    public function scopeOrderByKode($query, $direction = 'asc')
    {
        return $query->orderBy('kode_kategori', $direction);
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return $this->is_active ? 
            '<span class="badge bg-success">Aktif</span>' : 
            '<span class="badge bg-danger">Nonaktif</span>';
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        return $this->is_active ? 'Aktif' : 'Nonaktif';
    }

    /**
     * Check if kategori is active
     */
    public function isActive(): bool
    {
        return $this->is_active === true;
    }

    /**
     * Check if kategori is inactive
     */
    public function isInactive(): bool
    {
        return $this->is_active === false;
    }

    /**
     * Activate kategori
     */
    public function activate(): bool
    {
        return $this->update(['is_active' => true]);
    }

    /**
     * Deactivate kategori
     */
    public function deactivate(): bool
    {
        return $this->update(['is_active' => false]);
    }

    /**
     * Toggle status aktif/nonaktif
     */
    public function toggleStatus(): bool
    {
        return $this->update(['is_active' => !$this->is_active]);
    }

    /**
     * Get nama kategori dengan kode
     */
    public function getNamaWithKodeAttribute()
    {
        return "{$this->kode_kategori} - {$this->nama_kategori}";
    }

    /**
     * Get deskripsi singkat (jika terlalu panjang)
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
}