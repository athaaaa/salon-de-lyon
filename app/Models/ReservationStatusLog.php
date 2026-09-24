<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationStatusLog extends Model
{
    use HasFactory;

    /**
     * Nonaktifkan timestamp default Laravel (created_at & updated_at)
     * karena menggunakan kolom kustom `changed_at`.
     */
    public $timestamps = false;

    /**
     * Kolom yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reservation_id',
        'old_status',
        'new_status',
        'changed_by',
        'note',
        'changed_at',
    ];

    /**
     * Cast atribut ke tipe data tertentu.
     * Menggunakan properti $casts agar kompatibel di semua versi Laravel.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'changed_at' => 'datetime',
    ];

    /**
     * Auto-fill `changed_at` dengan waktu saat ini jika belum diisi.
     */
    protected static function booted(): void
    {
        static::creating(function ($log) {
            if (empty($log->changed_at)) {$log->changed_at = now();
            }
        });
    }

    /**
     * Relasi ke model Reservation.
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Relasi ke model User (pengubah status).
     */
    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    /**
     * Local scope untuk mengurutkan riwayat dari yang terbaru.
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('changed_at', 'desc');
    }
}