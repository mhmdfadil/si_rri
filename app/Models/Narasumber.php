<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Narasumber extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_narasumber',
        'nama_lengkap',
        'gelar_depan',
        'gelar_belakang',
        'instansi',
        'jabatan_instansi',
        'bidang_keahlian',
        'email',
        'telepon_kantor',
        'telepon_pribadi',
        'whatsapp',
        'telegram',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
        'tanggal_lahir',
        'jenis_kelamin',
        'tempat_lahir',
        'pendidikan_terakhir',
        'universitas',
        'linkedin',
        'facebook',
        'instagram',
        'twitter',
        'status',
        'catatan_khusus',
        'foto_profil',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Status options for dropdown
     */
    public const STATUS_OPTIONS = [
        'aktif' => 'Aktif',
        'nonaktif' => 'Non Aktif',
        'blacklist' => 'Blacklist',
        'pensiun' => 'Pensiun',
    ];

    /**
     * Jenis kelamin options
     */
    public const JENIS_KELAMIN_OPTIONS = [
        'L' => 'Laki-laki',
        'P' => 'Perempuan',
    ];

    /**
     * Scope untuk narasumber aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('kode_narasumber', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('bidang_keahlian', 'like', "%{$search}%");
    }

    /**
     * Get nama lengkap dengan gelar
     */
    public function getNamaLengkapWithGelarAttribute()
    {
        $nama = '';
        
        if ($this->gelar_depan) {
            $nama .= $this->gelar_depan . ' ';
        }
        
        $nama .= $this->nama_lengkap;
        
        if ($this->gelar_belakang) {
            $nama .= ', ' . $this->gelar_belakang;
        }
        
        return $nama;
    }

    /**
     * Get usia berdasarkan tanggal lahir
     */
    public function getUsiaAttribute()
    {
        if (!$this->tanggal_lahir) {
            return null;
        }
        
        return now()->diffInYears($this->tanggal_lahir);
    }

    /**
     * Get alamat lengkap
     */
    public function getAlamatLengkapAttribute()
    {
        $alamat = [];
        
        if ($this->alamat) {
            $alamat[] = $this->alamat;
        }
        if ($this->kelurahan) {
            $alamat[] = $this->kelurahan;
        }
        if ($this->kecamatan) {
            $alamat[] = $this->kecamatan;
        }
        if ($this->kota) {
            $alamat[] = $this->kota;
        }
        if ($this->provinsi) {
            $alamat[] = $this->provinsi;
        }
        if ($this->kode_pos) {
            $alamat[] = $this->kode_pos;
        }
        
        return implode(', ', $alamat);
    }

    /**
     * Accessor untuk mendapatkan URL foto
     */
    public function getFotoProfilUrlAttribute()
    {
        if ($this->foto_profil) {
            // Jika sudah URL
            if (filter_var($this->foto_profil, FILTER_VALIDATE_URL)) {
                return $this->foto_profil;
            }

            // Jika path storage
            return asset('storage/' . $this->foto_profil);
        }

        // Default avatar
        return asset('images/default-avatar.png');
    }

}