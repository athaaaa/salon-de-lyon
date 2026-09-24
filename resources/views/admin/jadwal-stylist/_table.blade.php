@php
    // Susun map [jam][stylist_id] = reservasi
    $map = [];
    foreach ($reservations as $r) {
        $map[substr($r->start_time, 0, 5)][$r->stylist_id] = $r;
    }
@endphp
<table class="w-full text-xs border border-stone-200">
    <thead class="bg-stone-50">
        <tr>
            <th class="border border-stone-200 px-3 py-2 text-left">Jam</th>
            @foreach ($stylists as $s)
                <th class="border border-stone-200 px-3 py-2">{{ $s->name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse ($slots as $slot)
            <tr>
                <td class="border border-stone-200 px-3 py-2 font-medium">{{ $slot }}</td>
                @foreach ($stylists as $s)
                    @php $r = $map[$slot][$s->id] ?? null; @endphp
                    <td class="border border-stone-200 px-3 py-2 text-center {{ $r ? 'bg-amber-50' : '' }}">
                        @if ($r)
                            <div class="font-medium text-stone-900">{{ $r->customer->name ?? '-' }}</div>
                            <div class="text-[10px] text-amber-800 font-normal mt-0.5">
                                {{ $r->treatment->name ?? $r->treatment->nama_treatment ?? '-' }}
                            </div>
                        @else
                            <span class="text-stone-400">-</span>
                        @endif
                    </td>
                @endforeach
            </tr>
        @empty
            <tr><td colspan="99" class="px-3 py-4 text-center text-stone-400">Tidak ada stylist aktif.</td></tr>
        @endforelse
    </tbody>
</table>