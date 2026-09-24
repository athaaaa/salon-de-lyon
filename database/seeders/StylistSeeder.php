<?php

namespace Database\Seeders;

use App\Models\Stylist;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class StylistSeeder extends Seeder
{
    /**
     * Data stylist masih dummy — nama & spesialisasi silakan diganti sendiri
     * lewat menu admin "Data Stylist" setelah aplikasi berjalan. Foto default
     * memakai avatar siluet lokal sesuai gender (lihat Stylist::getPhotoUrlAttribute);
     * upload foto asli lewat form edit stylist untuk menggantikannya.
     */
    public function run(): void
    {
        $stylists = [
            ['name' => 'Sarah', 'gender' => 'P', 'specialization' => 'Coloring & Styling', 'categories' => ['Color', 'Styling & Cut Package']],
            ['name' => 'Dinda', 'gender' => 'P', 'specialization' => 'Smoothing & Perm', 'categories' => ['Perm Woman', 'Perm Man']],
            ['name' => 'Rizky', 'gender' => 'L', 'specialization' => 'Hair Cut & Men Style', 'categories' => ['Cut Man', 'Cut Woman']],
            ['name' => 'Dimas', 'gender' => 'L', 'specialization' => 'Treatment & Hair Spa', 'categories' => ['Clinic Hair & Mucota', 'Scalp Care']],
        ];

        foreach ($stylists as $s) {
            $stylist = Stylist::create([
                'name' => $s['name'],
                'specialization' => $s['specialization'],
                'gender' => $s['gender'],
                'photo' => null,
                'status' => 'aktif',
            ]);

            $treatmentIds = Treatment::whereIn('category', $s['categories'])->pluck('id');
            $stylist->treatments()->sync($treatmentIds);
        }
    }
}
