<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    protected $fillable = [
        'name', 'specialization', 'gender', 'photo', 'status',
    ];

    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'stylist_treatment');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Kalau foto stylist belum diupload, pakai avatar siluet lokal sesuai gender
     * (bukan layanan pihak ketiga) supaya tetap tampil rapi tanpa foto asli.
     * Upload foto stylist sungguhan lewat menu admin > Data Stylist akan
     * otomatis menggantikan avatar ini.
     */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        return $this->gender === 'L'
            ? asset('images/avatar-male.svg')
            : asset('images/avatar-female.svg');
    }
}
