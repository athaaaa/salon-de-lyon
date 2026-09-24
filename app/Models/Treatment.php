<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'name', 'category', 'description', 'price', 'duration_minutes', 'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function stylists()
    {
        return $this->belongsToMany(Stylist::class, 'stylist_treatment');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }
}
