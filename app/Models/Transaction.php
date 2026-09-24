<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_code', 'reservation_id', 'total_amount',
        'payment_status', 'payment_method', 'transaction_date', 'processed_by',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'transaction_date' => 'datetime',
        ];
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public static function generateCode(): string
    {
        $last = static::orderByDesc('id')->first();
        $next = $last ? $last->id + 1 : 1;

        return 'TRX-' . str_pad((string) $next, 6, '0', STR_PAD_LEFT);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->total_amount, 0, ',', '.');
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->transaction_date 
            ? $this->transaction_date->translatedFormat('d M Y') 
            : '-';
    }
}