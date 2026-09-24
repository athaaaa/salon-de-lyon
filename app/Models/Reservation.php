<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Reservation extends Model
{
    protected $fillable = [
        'reservation_code', 'customer_id', 'stylist_id', 'treatment_id',
        'reservation_date', 'start_time', 'end_time', 'source', 'status',
        'notes', 'cancelled_reason', 'created_by',
    ];

    /**
     * Cast kolom reservation_date otomatis menjadi objek Carbon / Date
     */
    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function stylist()
    {
        return $this->belongsTo(Stylist::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(ReservationStatusLog::class)->orderByDesc('changed_at');
    }

    /**
     * Generate kode reservasi unik, format: RSV-000125
     */
    public static function generateCode(): string
    {
        $last = static::orderByDesc('id')->first();
        $next = $last ? $last->id + 1 : 1;

        return 'RSV-' . str_pad((string) $next, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Cek apakah jadwal stylist pada tanggal & jam tertentu bentrok
     * dengan reservasi lain yang masih aktif (bukan Dibatalkan).
     *
     * @param  int|null  $excludeReservationId  dipakai saat mengubah/reschedule reservasi yang sudah ada
     */
    public static function isScheduleTaken(
        int $stylistId,
        string $date,
        string $startTime,
        string $endTime,
        ?int $excludeReservationId = null
    ): bool {
        $query = static::where('stylist_id', $stylistId)
            ->where('reservation_date', $date)
            ->where('status', '!=', 'Dibatalkan')
            ->where('start_time', '<', $endTime)
            ->where('end_time', '>', $startTime);

        if ($excludeReservationId) {
            $query->where('id', '!=', $excludeReservationId);
        }

        return $query->exists();
    }

    /**
     * Hitung jam selesai otomatis dari jam mulai + durasi treatment (menit).
     */
    public static function calculateEndTime(string $startTime, int $durationMinutes): string
    {
        return Carbon::createFromFormat('H:i', $startTime)
            ->addMinutes($durationMinutes)
            ->format('H:i');
    }

    /**
     * Ubah status reservasi sekaligus mencatat ke reservation_status_logs.
     */
    public function changeStatus(string $newStatus, ?int $changedBy = null, ?string $note = null): void
    {
        $old = $this->status;
        $this->status = $newStatus;
        $this->save();

        $this->statusLogs()->create([
            'old_status' => $old,
            'new_status' => $newStatus,
            'changed_by' => $changedBy,
            'note' => $note,
            'changed_at' => now(),
        ]);
    }

    public function scopeBetweenDates($query, $start, $end)
    {
        return $query->whereBetween('reservation_date', [$start, $end]);
    }
}