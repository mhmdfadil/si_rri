<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class KontenSiaran extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'konten_siarans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_konten',
        'judul',
        'program_id',
        'kategori_id',
        'tanggal_siaran',
        'jam_siaran',
        'durasi',
        'segmen',
        'tipe_siaran',
        'jenis_konten',
        'studio',
        'produser',
        'penyiar',
        'operator',
        'tim_produksi',
        'deskripsi',
        'topik_bahasan',
        'rundown',
        'naskah',
        'catatan_produksi',
        'file_audio',
        'thumbnail',
        'file_pendukung',
        'hashtag',
        'kata_kunci',
        'jumlah_pendengar',
        'rating',
        'status',
        'diajukan_oleh',
        'disetujui_oleh',
        'tanggal_diajukan',
        'tanggal_disetujui',
        'catatan_approval',
        'dapat_diulang',
        'tanggal_tayang_ulang',
        'arsip',
        'nomor_arsip',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_siaran' => 'date',
        'jam_siaran' => 'datetime',
        'tanggal_diajukan' => 'datetime',
        'tanggal_disetujui' => 'datetime',
        'tanggal_tayang_ulang' => 'datetime',
        'durasi' => 'integer',
        'jumlah_pendengar' => 'integer',
        'rating' => 'decimal:2',
        'dapat_diulang' => 'boolean',
        'arsip' => 'boolean',
        'tim_produksi' => 'array',
        'file_pendukung' => 'array',
    ];

    /**
     * Status options
     */
    public const STATUS_OPTIONS = [
        'draft' => 'Draft',
        'diajukan' => 'Diajukan',
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
        'siap_tayang' => 'Siap Tayang',
        'tayang' => 'Sedang Tayang',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];

    /**
     * Tipe siaran options
     */
    public const TIPE_SIARAN_OPTIONS = [
        'live' => 'Live',
        'rekaman' => 'Rekaman',
        'tunda' => 'Tunda',
    ];

    /**
     * Jenis konten options
     */
    public const JENIS_KONTEN_OPTIONS = [
        'wawancara' => 'Wawancara',
        'talkshow' => 'Talkshow',
        'berita' => 'Berita',
        'feature' => 'Feature',
        'musik' => 'Musik',
        'dialog' => 'Dialog',
        'lainnya' => 'Lainnya',
    ];

    /**
     * Relasi ke model Program
     */
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

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
        return $this->belongsToMany(Narasumber::class, 'konten_siaran_narasumber', 'konten_siaran_id', 'narasumber_id')
                    ->withPivot('peran', 'durasi_tampil', 'honor', 'catatan')
                    ->withTimestamps();
    }

    /**
     * Relasi ke user yang mengajukan
     */
    public function pengaju()
    {
        return $this->belongsTo(User::class, 'diajukan_oleh');
    }

    /**
     * Relasi ke user yang menyetujui
     */
    public function penyetuju()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    /**
     * Scope untuk konten draft
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope untuk konten diajukan
     */
    public function scopeDiajukan($query)
    {
        return $query->where('status', 'diajukan');
    }

    /**
     * Scope untuk konten disetujui
     */
    public function scopeDisetujui($query)
    {
        return $query->where('status', 'disetujui');
    }

    /**
     * Scope untuk konten siap tayang
     */
    public function scopeSiapTayang($query)
    {
        return $query->where('status', 'siap_tayang');
    }

    /**
     * Scope untuk konten tayang
     */
    public function scopeTayang($query)
    {
        return $query->where('status', 'tayang');
    }

    /**
     * Scope untuk konten selesai
     */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    /**
     * Scope untuk konten live
     */
    public function scopeLive($query)
    {
        return $query->where('tipe_siaran', 'live');
    }

    /**
     * Scope untuk konten rekaman
     */
    public function scopeRekaman($query)
    {
        return $query->where('tipe_siaran', 'rekaman');
    }

    /**
     * Scope untuk konten hari ini
     */
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal_siaran', today());
    }

    /**
     * Scope untuk konten besok
     */
    public function scopeBesok($query)
    {
        return $query->whereDate('tanggal_siaran', today()->addDay());
    }

    /**
     * Scope untuk konten minggu ini
     */
    public function scopeMingguIni($query)
    {
        return $query->whereBetween('tanggal_siaran', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    /**
     * Scope untuk konten bulan ini
     */
    public function scopeBulanIni($query)
    {
        return $query->whereYear('tanggal_siaran', now()->year)
                    ->whereMonth('tanggal_siaran', now()->month);
    }

    /**
     * Scope untuk konten berdasarkan tanggal
     */
    public function scopeByTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal_siaran', $tanggal);
    }

    /**
     * Scope untuk konten berdasarkan rentang tanggal
     */
    public function scopeByRentangTanggal($query, $dari, $sampai)
    {
        return $query->whereBetween('tanggal_siaran', [$dari, $sampai]);
    }

    /**
     * Scope untuk konten arsip
     */
    public function scopeArsip($query)
    {
        return $query->where('arsip', true);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('kode_konten', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('topik_bahasan', 'like', "%{$search}%")
                    ->orWhere('kata_kunci', 'like', "%{$search}%")
                    ->orWhereHas('program', function($q) use ($search) {
                        $q->where('nama_program', 'like', "%{$search}%");
                    })
                    ->orWhereHas('narasumbers', function($q) use ($search) {
                        $q->where('nama_lengkap', 'like', "%{$search}%");
                    });
    }

    /**
     * Scope filter berdasarkan program
     */
    public function scopeByProgram($query, $programId)
    {
        return $query->where('program_id', $programId);
    }

    /**
     * Scope filter berdasarkan jenis konten
     */
    public function scopeByJenisKonten($query, $jenis)
    {
        return $query->where('jenis_konten', $jenis);
    }

    /**
     * Scope filter berdasarkan tipe siaran
     */
    public function scopeByTipeSiaran($query, $tipe)
    {
        return $query->where('tipe_siaran', $tipe);
    }

    /**
     * Get status label dengan warna
     */
    public function getStatusLabelAttribute()
    {
        $colors = [
            'draft' => 'secondary',
            'diajukan' => 'info',
            'disetujui' => 'primary',
            'ditolak' => 'danger',
            'siap_tayang' => 'warning',
            'tayang' => 'success',
            'selesai' => 'dark',
            'dibatalkan' => 'danger',
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
     * Get tipe siaran text
     */
    public function getTipeSiaranTextAttribute()
    {
        return self::TIPE_SIARAN_OPTIONS[$this->tipe_siaran] ?? $this->tipe_siaran;
    }

    /**
     * Get jenis konten text
     */
    public function getJenisKontenTextAttribute()
    {
        return self::JENIS_KONTEN_OPTIONS[$this->jenis_konten] ?? $this->jenis_konten;
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
     * Get tanggal siaran formatted
     */
    public function getTanggalSiaranFormattedAttribute()
    {
        return $this->tanggal_siaran->format('d F Y');
    }

    /**
     * Get jam siaran formatted
     */
    public function getJamSiaranFormattedAttribute()
    {
        return Carbon::parse($this->jam_siaran)->format('H:i');
    }

    /**
     * Get waktu siaran lengkap
     */
    public function getWaktuSiaranLengkapAttribute()
    {
        return $this->tanggal_siaran->format('d F Y') . ' pukul ' . Carbon::parse($this->jam_siaran)->format('H:i') . ' WIB';
    }

    /**
     * Get file audio URL
     */
    public function getFileAudioUrlAttribute()
    {
        if ($this->file_audio) {
            if (filter_var($this->file_audio, FILTER_VALIDATE_URL)) {
                return $this->file_audio;
            }
            return asset('storage/' . $this->file_audio);
        }
        return null;
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
                return $this->thumbnail;
            }
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/default-thumbnail.png');
    }

    /**
     * Check if konten is draft
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Check if konten is tayang
     */
    public function isTayang(): bool
    {
        return $this->status === 'tayang';
    }

    /**
     * Check if konten is selesai
     */
    public function isSelesai(): bool
    {
        return $this->status === 'selesai';
    }

    /**
     * Check if konten is live
     */
    public function isLive(): bool
    {
        return $this->tipe_siaran === 'live';
    }

    /**
     * Check if konten sedang tayang sekarang
     */
    public function isSedangTayang(): bool
    {
        if ($this->status !== 'tayang') {
            return false;
        }

        $now = now();
        $mulai = Carbon::parse($this->tanggal_siaran->format('Y-m-d') . ' ' . Carbon::parse($this->jam_siaran)->format('H:i:s'));
        $selesai = $mulai->copy()->addMinutes($this->durasi);

        return $now->between($mulai, $selesai);
    }

    /**
     * Ajukan konten
     */
    public function ajukan($userId = null): bool
    {
        return $this->update([
            'status' => 'diajukan',
            'diajukan_oleh' => $userId ?? auth()->id(),
            'tanggal_diajukan' => now(),
        ]);
    }

    /**
     * Setujui konten
     */
    public function setujui($userId = null, $catatan = null): bool
    {
        return $this->update([
            'status' => 'disetujui',
            'disetujui_oleh' => $userId ?? auth()->id(),
            'tanggal_disetujui' => now(),
            'catatan_approval' => $catatan,
        ]);
    }

    /**
     * Tolak konten
     */
    public function tolak($catatan = null): bool
    {
        return $this->update([
            'status' => 'ditolak',
            'catatan_approval' => $catatan,
        ]);
    }

    /**
     * Siapkan tayang
     */
    public function siapkanTayang(): bool
    {
        return $this->update(['status' => 'siap_tayang']);
    }

    /**
     * Mulai tayang
     */
    public function mulaiTayang(): bool
    {
        return $this->update(['status' => 'tayang']);
    }

    /**
     * Selesai tayang
     */
    public function selesaiTayang(): bool
    {
        return $this->update(['status' => 'selesai']);
    }

    /**
     * Batalkan konten
     */
    public function batalkan(): bool
    {
        return $this->update(['status' => 'dibatalkan']);
    }

    /**
     * Arsipkan konten
     */
    public function arsipkan($nomorArsip = null): bool
    {
        return $this->update([
            'arsip' => true,
            'nomor_arsip' => $nomorArsip ?? 'ARS-' . $this->id . '-' . now()->format('Ymd'),
        ]);
    }

    /**
     * Count jumlah narasumber
     */
    public function countNarasumbers()
    {
        return $this->narasumbers()->count();
    }

    /**
     * Get total honor
     */
    public function getTotalHonorAttribute()
    {
        return $this->narasumbers()->sum('honor');
    }

    /**
     * Get deskripsi singkat
     */
    public function getDeskripsiSingkatAttribute()
    {
        if (!$this->deskripsi) {
            return '-';
        }

        $limit = 150;
        if (strlen($this->deskripsi) <= $limit) {
            return $this->deskripsi;
        }

        return substr($this->deskripsi, 0, $limit) . '...';
    }
}