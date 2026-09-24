<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'address',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Total kunjungan dihitung dari reservasi berstatus Selesai
     * (tidak disimpan sebagai kolom, lihat catatan skema database).
     */
    public function getTotalKunjunganAttribute(): int
    {
        return $this->reservations()->where('status', 'Selesai')->count();
    }
}
