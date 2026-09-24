<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function reservationsCreated()
    {
        return $this->hasMany(Reservation::class, 'created_by');
    }

    public function transactionsProcessed()
    {
        return $this->hasMany(Transaction::class, 'processed_by');
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'kasir']) && $this->status === 'aktif';
    }
}
