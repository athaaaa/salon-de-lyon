@php
/**
 * Sistem ikon SVG sederhana (outline, tanpa isi warna selain currentColor)
 * dipakai di seluruh aplikasi menggantikan emoji. Panggil dengan:
 * @include('partials.icon', ['name' => 'calendar', 'class' => 'w-5 h-5'])
 */
$icons = [
    'dashboard'  => 'M3 13h4v8H3v-8Zm7-8h4v16h-4V5Zm7 4h4v12h-4V9Z',
    'calendar'   => 'M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z',
    'users'      => 'M17 20v-1a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1m18 0v-1a4 4 0 0 0-3-3.87M15 3.13a4 4 0 0 1 0 7.75M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z',
    'user'       => 'M20 21v-1a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v1m12-13a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z',
    'scissors'   => 'M6 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm0 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm14-14L8.5 13.5M20 19 8.5 7.5',
    'sparkle'    => 'M12 3v3m0 12v3m9-9h-3M6 12H3m14.5-6.5-2 2m-9 9-2 2m0-13 2 2m9 9 2 2M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z',
    'card'       => 'M3 10h18M5 6h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2Zm2 8h4',
    'clock'      => 'M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
    'chart'      => 'M4 19V9m6 10V5m6 14v-7m6 7V3',
    'clipboard'  => 'M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2m-6 0a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 12h6m-6 4h6',
    'logout'     => 'M9 21H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3m6 14 5-5-5-5m5 5H9',
    'printer'    => 'M7 8V4a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v4M6 18H5a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-1m-12 0v3a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-3m-10 0h10',
    'home'       => 'M4 11.5 12 4l8 7.5M6 10v9a1 1 0 0 0 1 1h3v-6h4v6h3a1 1 0 0 0 1-1v-9',
    'chevron-left'  => 'm15 18-6-6 6-6',
    'chevron-right' => 'm9 6 6 6-6 6',
    'check-circle'  => 'M9 12.5l2 2 4-4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
    'x-circle'      => 'm15 9-6 6m0-6 6 6m6-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
    'info-circle'   => 'M12 16v-4m0-4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
    'search'        => 'm21 21-4.3-4.3M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z',
    'plus'          => 'M12 5v14m-7-7h14',
    'edit'          => 'M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5m-1.5-9.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z',
    'trash'         => 'M3 6h18M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2m3 0-1 14a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1L5 6h14Z',
    'building'      => 'M4 21V5a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v16M4 21h16M4 21H2m18 0h2m-9-16h6a1 1 0 0 1 1 1v14M8 8h.01M8 12h.01M8 16h.01',
    'phone'         => 'M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92Z',
];
$path = $icons[$name] ?? '';
$class = $class ?? 'w-5 h-5';
$stroke = $stroke ?? 2;
@endphp
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="{{ $stroke }}" stroke-linecap="round" stroke-linejoin="round"
     class="{{ $class }}" aria-hidden="true">
    <path d="{{ $path }}"></path>
</svg>
