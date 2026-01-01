<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photos',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    /**
     * Mutator untuk mengubah email ke lowercase sebelum disimpan
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Accessor untuk mendapatkan URL foto
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photos) {
            // Jika photos berisi URL lengkap
            if (filter_var($this->photos, FILTER_VALIDATE_URL)) {
                return $this->photos;
            }
            
            // Jika photos berisi path relatif
            return asset('storage/' . $this->photos);
        }
        
        // Foto default jika tidak ada
        return asset('images/default-avatar.png');
    }

    /**
     * Scope untuk user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk user non-aktif
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Update waktu login terakhir
     */
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }
}