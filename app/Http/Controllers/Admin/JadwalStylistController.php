<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JadwalStylistController extends Controller
{
    /**
     * Slot jam operasional salon (10:00 - 19:00), dipakai untuk membangun tabel jadwal.
     */
    public const SLOTS = [
        '10:00', '11:00', '12:00', '13:00', '14:00',
        '15:00', '16:00', '17:00', '18:00', '19:00',
    ];

    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $stylistId = $request->input('stylist_id');

        $stylists = Stylist::active()
            ->when($stylistId, fn ($q) => $q->where('id', $stylistId))
            ->orderBy('name')
            ->get();

        $reservations = Reservation::with(['customer', 'stylist'])
            ->where('reservation_date', $date)
            ->where('status', '!=', 'Dibatalkan')
            ->when($stylistId, fn ($q) => $q->where('stylist_id', $stylistId))
            ->get();

        $allStylists = Stylist::active()->orderBy('name')->get();

        $data = [
            'date' => Carbon::parse($date),
            'stylists' => $stylists,
            'allStylists' => $allStylists,
            'reservations' => $reservations,
            'slots' => self::SLOTS,
            'selectedStylistId' => $stylistId,
        ];

        if ($request->boolean('print')) {
            return view('admin.jadwal-stylist.print', $data);
        }

        return view('admin.jadwal-stylist.index', $data);
    }
}