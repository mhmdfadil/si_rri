<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class KontenSiaranNarasumber extends Pivot
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'konten_siaran_narasumber';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'konten_siaran_id',
        'narasumber_id',
        'peran',
        'durasi_tampil',
        'honor',
        'catatan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'durasi_tampil' => 'integer',
        'honor' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Peran options untuk narasumber
     */
    public const PERAN_OPTIONS = [
        'narasumber_utama' => 'Narasumber Utama',
        'narasumber_pendamping' => 'Narasumber Pendamping',
        'tamu_khusus' => 'Tamu Khusus',
        'pembicara' => 'Pembicara',
        'komentator' => 'Komentator',
        'pakar' => 'Pakar',
        'tokoh' => 'Tokoh',
        'pelaku_usaha' => 'Pelaku Usaha',
        'pejabat' => 'Pejabat',
        'aktivis' => 'Aktivis',
        'seniman' => 'Seniman',
        'atlet' => 'Atlet',
        'moderator' => 'Moderator',
        'presenter' => 'Presenter',
        'lainnya' => 'Lainnya',
    ];

    /**
     * Relasi ke model KontenSiaran
     */
    public function kontenSiaran()
    {
        return $this->belongsTo(KontenSiaran::class, 'konten_siaran_id');
    }

    /**
     * Relasi ke model Narasumber
     */
    public function narasumber()
    {
        return $this->belongsTo(Narasumber::class, 'narasumber_id');
    }

    /**
     * Scope untuk filter berdasarkan konten siaran
     */
    public function scopeByKontenSiaran($query, $kontenSiaranId)
    {
        return $query->where('konten_siaran_id', $kontenSiaranId);
    }

    /**
     * Scope untuk filter berdasarkan narasumber
     */
    public function scopeByNarasumber($query, $narasumberId)
    {
        return $query->where('narasumber_id', $narasumberId);
    }

    /**
     * Scope untuk filter berdasarkan peran
     */
    public function scopeByPeran($query, $peran)
    {
        return $query->where('peran', $peran);
    }

    /**
     * Scope untuk narasumber utama
     */
    public function scopeNarasumberUtama($query)
    {
        return $query->where('peran', 'narasumber_utama');
    }

    /**
     * Scope untuk urut berdasarkan honor tertinggi
     */
    public function scopeOrderByHonorDesc($query)
    {
        return $query->orderBy('honor', 'desc');
    }

    /**
     * Scope untuk urut berdasarkan durasi tampil terlama
     */
    public function scopeOrderByDurasiDesc($query)
    {
        return $query->orderBy('durasi_tampil', 'desc');
    }

    /**
     * Get peran text
     */
    public function getPeranTextAttribute()
    {
        return self::PERAN_OPTIONS[$this->peran] ?? $this->peran;
    }

    /**
     * Get durasi tampil dalam format
     */
    public function getDurasiTampilFormattedAttribute()
    {
        if (!$this->durasi_tampil) {
            return '-';
        }

        if ($this->durasi_tampil < 60) {
            return $this->durasi_tampil . ' menit';
        }
        
        $jam = floor($this->durasi_tampil / 60);
        $menit = $this->durasi_tampil % 60;
        
        if ($menit == 0) {
            return $jam . ' jam';
        }
        
        return $jam . ' jam ' . $menit . ' menit';
    }

    /**
     * Get honor formatted dengan Rupiah
     */
    public function getHonorFormattedAttribute()
    {
        if (!$this->honor) {
            return 'Rp 0';
        }

        return 'Rp ' . number_format($this->honor, 0, ',', '.');
    }

    /**
     * Get nama narasumber lengkap dengan gelar
     */
    public function getNamaNarasumberLengkapAttribute()
    {
        return $this->narasumber ? $this->narasumber->nama_lengkap_with_gelar : '-';
    }

    /**
     * Get nama narasumber
     */
    public function getNamaNarasumberAttribute()
    {
        return $this->narasumber ? $this->narasumber->nama_lengkap : '-';
    }

    /**
     * Get instansi narasumber
     */
    public function getInstansiNarasumberAttribute()
    {
        return $this->narasumber ? $this->narasumber->instansi : '-';
    }

    /**
     * Get bidang keahlian narasumber
     */
    public function getBidangKeahlianNarasumberAttribute()
    {
        return $this->narasumber ? $this->narasumber->bidang_keahlian : '-';
    }

    /**
     * Get judul konten siaran
     */
    public function getJudulKontenAttribute()
    {
        return $this->kontenSiaran ? $this->kontenSiaran->judul : '-';
    }

    /**
     * Get kode konten siaran
     */
    public function getKodeKontenAttribute()
    {
        return $this->kontenSiaran ? $this->kontenSiaran->kode_konten : '-';
    }

    /**
     * Get tanggal siaran
     */
    public function getTanggalSiaranAttribute()
    {
        return $this->kontenSiaran ? $this->kontenSiaran->tanggal_siaran : null;
    }

    /**
     * Get program name
     */
    public function getNamaProgramAttribute()
    {
        return $this->kontenSiaran && $this->kontenSiaran->program 
            ? $this->kontenSiaran->program->nama_program 
            : '-';
    }

    /**
     * Check if narasumber is narasumber utama
     */
    public function isNarasumberUtama(): bool
    {
        return $this->peran === 'narasumber_utama';
    }

    /**
     * Check if has honor
     */
    public function hasHonor(): bool
    {
        return $this->honor && $this->honor > 0;
    }

    /**
     * Calculate persentase durasi tampil dari total durasi konten
     */
    public function getPersentaseDurasiAttribute()
    {
        if (!$this->durasi_tampil || !$this->kontenSiaran || !$this->kontenSiaran->durasi) {
            return 0;
        }

        return round(($this->durasi_tampil / $this->kontenSiaran->durasi) * 100, 2);
    }

    /**
     * Get informasi lengkap narasumber untuk tampilan
     */
    public function getInfoLengkapAttribute()
    {
        $info = [];
        
        $info['nama'] = $this->nama_narasumber_lengkap;
        $info['peran'] = $this->peran_text;
        
        if ($this->instansi_narasumber !== '-') {
            $info['instansi'] = $this->instansi_narasumber;
        }
        
        if ($this->durasi_tampil) {
            $info['durasi'] = $this->durasi_tampil_formatted;
        }
        
        if ($this->hasHonor()) {
            $info['honor'] = $this->honor_formatted;
        }
        
        return $info;
    }

    /**
     * Static method untuk mendapatkan total honor berdasarkan konten siaran
     */
    public static function getTotalHonorByKonten($kontenSiaranId)
    {
        return self::where('konten_siaran_id', $kontenSiaranId)->sum('honor');
    }

    /**
     * Static method untuk mendapatkan jumlah narasumber berdasarkan konten siaran
     */
    public static function getCountByKonten($kontenSiaranId)
    {
        return self::where('konten_siaran_id', $kontenSiaranId)->count();
    }

    /**
     * Static method untuk mendapatkan total durasi tampil berdasarkan konten siaran
     */
    public static function getTotalDurasiByKonten($kontenSiaranId)
    {
        return self::where('konten_siaran_id', $kontenSiaranId)->sum('durasi_tampil');
    }

    /**
     * Get statistik narasumber untuk konten tertentu
     */
    public static function getStatistikByKonten($kontenSiaranId)
    {
        return [
            'total_narasumber' => self::getCountByKonten($kontenSiaranId),
            'total_honor' => self::getTotalHonorByKonten($kontenSiaranId),
            'total_durasi' => self::getTotalDurasiByKonten($kontenSiaranId),
            'honor_formatted' => 'Rp ' . number_format(self::getTotalHonorByKonten($kontenSiaranId), 0, ',', '.'),
        ];
    }
}