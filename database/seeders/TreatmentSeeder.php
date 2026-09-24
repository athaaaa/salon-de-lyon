<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Data diambil langsung dari MENU_SALON_DE_LYON.pdf.
     * Durasi dikonversi ke menit (dibulatkan ke batas atas rentang durasi di menu).
     * Untuk layanan dengan rentang harga (mis. "400k / 500k" tergantung panjang rambut),
     * dipakai harga dasar (angka pertama); tambahan harga dicatat di description.
     */
    public function run(): void
    {
        $treatments = [

            // 1. CUT WOMAN
            ['category' => 'Cut Woman', 'name' => 'Wanita Cut Dewasa', 'price' => 400000, 'duration_minutes' => 60,
                'description' => "Gunting + Blow. Tambahan untuk rambut panjang 'all-wave blow': +Rp 50.000."],
            ['category' => 'Cut Woman', 'name' => 'Wanita Cut Remaja', 'price' => 300000, 'duration_minutes' => 45,
                'description' => 'Untuk usia SMP - SMA.'],
            ['category' => 'Cut Woman', 'name' => 'Wanita Cut Anak-anak', 'price' => 200000, 'duration_minutes' => 40,
                'description' => 'Di bawah SD kelas 6.'],
            ['category' => 'Cut Woman', 'name' => 'Wanita Cut Scaling', 'price' => 600000, 'duration_minutes' => 75,
                'description' => 'Membuka pori-pori tersumbat, membantu pertumbuhan rambut, scaling kapalan & sebum, memberi gizi langsung dari luar (scaling kulit rambut + tonik).'],
            ['category' => 'Cut Woman', 'name' => 'Wanita Cut Scalp Massage', 'price' => 700000, 'duration_minutes' => 90,
                'description' => 'Cut Scaling + massage peredaran darah kepala, kulit, dan bahu + penguat rambut PPT.'],
            ['category' => 'Cut Woman', 'name' => 'Cut Mucota', 'price' => 700000, 'duration_minutes' => 90,
                'description' => 'Konsentrasi nutrisi rambut rusak singkat. Curl elastis, efek penumbuhan, sistem reaksi Mucota (45 tingkat pemberian nutrisi).'],
            ['category' => 'Cut Woman', 'name' => 'Cut Root-Volume', 'price' => 700000, 'duration_minutes' => 90,
                'description' => 'Pemberian volume di bagian akar rambut setelah perm, meskipun curl bagian bawah sudah cukup bagus.'],

            // 2. CUT MAN
            ['category' => 'Cut Man', 'name' => 'Pria Cut Dewasa', 'price' => 300000, 'duration_minutes' => 45,
                'description' => 'Gunting + Styling standard.'],
            ['category' => 'Cut Man', 'name' => 'Pria Cut Remaja', 'price' => 250000, 'duration_minutes' => 30,
                'description' => 'Untuk usia SMP - SMA.'],
            ['category' => 'Cut Man', 'name' => 'Pria Cut Anak-anak', 'price' => 200000, 'duration_minutes' => 30,
                'description' => 'Di bawah SD kelas 6.'],
            ['category' => 'Cut Man', 'name' => 'Pria Cut Scaling', 'price' => 500000, 'duration_minutes' => 60,
                'description' => 'Membuka pori-pori tersumbat, membantu pertumbuhan rambut, scaling kapalan & sebum, nutrisi kulit kepala.'],
            ['category' => 'Cut Man', 'name' => 'Pria Cut Scalp Massage', 'price' => 600000, 'duration_minutes' => 60,
                'description' => 'Cut Scaling + massage peredaran darah kepala, kulit, dan bahu + penguat rambut PPT.'],
            ['category' => 'Cut Man', 'name' => 'Basic Side Down Cut', 'price' => 500000, 'duration_minutes' => 60,
                'description' => 'Perawatan menurunkan rambut terapung di bagian samping dan leher belakang dengan produk perm.'],
            ['category' => 'Cut Man', 'name' => 'Magic Side Down Cut', 'price' => 500000, 'duration_minutes' => 75,
                'description' => 'Perawatan menurunkan rambut terapung di bagian samping dan leher belakang dengan volume magic.'],

            // 3. PERM WOMAN
            ['category' => 'Perm Woman', 'name' => 'Basic Perm', 'price' => 1000000, 'duration_minutes' => 150,
                'description' => 'Perm biasa.'],
            ['category' => 'Perm Woman', 'name' => 'Clinic Perm', 'price' => 1200000, 'duration_minutes' => 150,
                'description' => 'Perm klinik (dengan nutrisi).'],
            ['category' => 'Perm Woman', 'name' => 'Straight Perm', 'price' => 1000000, 'duration_minutes' => 180,
                'description' => 'Perm lurus / smoothing.'],
            ['category' => 'Perm Woman', 'name' => 'Magic Perm', 'price' => 1200000, 'duration_minutes' => 210,
                'description' => 'Pelurusan magic.'],
            ['category' => 'Perm Woman', 'name' => 'Volume Magic Perm', 'price' => 1500000, 'duration_minutes' => 240,
                'description' => 'Volume magic.'],
            ['category' => 'Perm Woman', 'name' => 'Digital Perm', 'price' => 2000000, 'duration_minutes' => 210,
                'description' => 'Perm digital.'],
            ['category' => 'Perm Woman', 'name' => 'Mix Perm', 'price' => 2500000, 'duration_minutes' => 270,
                'description' => 'Volume magic + digital.'],
            ['category' => 'Perm Woman', 'name' => 'Root Perm', 'price' => 400000, 'duration_minutes' => 90,
                'description' => 'Partial (volume keseluruhan spesial): Rp 400.000. Whole (akar rambut atas, samping & crown): Rp 800.000.'],
            ['category' => 'Perm Woman', 'name' => 'Poni Perm', 'price' => 200000, 'duration_minutes' => 60,
                'description' => 'Perm khusus bagian poni.'],

            // PERM MAN
            ['category' => 'Perm Man', 'name' => 'Basic Perm (Pria)', 'price' => 800000, 'duration_minutes' => 120,
                'description' => 'Perm standar pria.'],
            ['category' => 'Perm Man', 'name' => 'Clinic Perm (Pria)', 'price' => 1000000, 'duration_minutes' => 120,
                'description' => 'Perm klinik pria.'],
            ['category' => 'Perm Man', 'name' => 'Down + Volume Perm', 'price' => 1000000, 'duration_minutes' => 120,
                'description' => 'Kombinasi down perm & volume perm.'],
            ['category' => 'Perm Man', 'name' => 'Magic (Pria)', 'price' => 1000000, 'duration_minutes' => 150,
                'description' => 'Pelurusan magic pria.'],
            ['category' => 'Perm Man', 'name' => 'Volume Magic (Pria)', 'price' => 1500000, 'duration_minutes' => 150,
                'description' => 'Volume magic pria.'],
            ['category' => 'Perm Man', 'name' => 'Perm Spesial', 'price' => 0, 'duration_minutes' => 120,
                'description' => 'Custom perm (setelah konsultasi) — harga bervariasi, hubungi kasir.'],

            // 4. COLOR
            ['category' => 'Color', 'name' => 'Basic Color', 'price' => 700000, 'duration_minutes' => 120,
                'description' => 'Pewarnaan dasar. Wanita: Rp 800.000 / Pria: Rp 700.000.'],
            ['category' => 'Color', 'name' => 'Clinic Color', 'price' => 900000, 'duration_minutes' => 120,
                'description' => 'Refleksi sinar dan tambahan ampul perobatan.'],
            ['category' => 'Color', 'name' => 'Premium Color', 'price' => 1000000, 'duration_minutes' => 150,
                'description' => 'Dengan 2 jenis ampul persediaan air & membantu kelembutan rambut.'],
            ['category' => 'Color', 'name' => 'Inoa Color', 'price' => 1000000, 'duration_minutes' => 120,
                'description' => 'Tidak bau, tanpa amoniak, kulit kepala tenang, proteksi rambut, pewarna mengkilap.'],
            ['category' => 'Color', 'name' => 'Penutup Color (Uban)', 'price' => 600000, 'duration_minutes' => 120,
                'description' => 'Manfaat khusus customer yang coloring 1x/lebih dalam sebulan. Service perobatan PPT pada rambut (Cut + Coloring + Perobatan PPT).'],
            ['category' => 'Color', 'name' => 'Mucota & Color', 'price' => 1300000, 'duration_minutes' => 180,
                'description' => 'Pertemuan color dengan mucota (kombinasi superlatif).'],
            ['category' => 'Color', 'name' => 'Hena', 'price' => 800000, 'duration_minutes' => 120,
                'description' => 'Perangsang ke rambut & kulit hampir tidak ada, tahan lama, efek pengobatan lebih lama.'],
            ['category' => 'Color', 'name' => 'Squid Tinta', 'price' => 800000, 'duration_minutes' => 120,
                'description' => 'Pewarnaan tinta cumi (alami & pekat).'],
            ['category' => 'Color', 'name' => 'Manicure & Waxing', 'price' => 800000, 'duration_minutes' => 120,
                'description' => 'Mengkilap dan elastisitas sangat tinggi oleh coating kuat di atas cuticle.'],
            ['category' => 'Color', 'name' => 'Bleaching', 'price' => 600000, 'duration_minutes' => 90,
                'description' => '1 kali bleach.'],

            // 5. CLINIC HAIR & MUCOTA PACKAGE
            ['category' => 'Clinic Hair & Mucota', 'name' => 'Water Care', 'price' => 500000, 'duration_minutes' => 60,
                'description' => 'Persediaan air.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => 'Protein Care', 'price' => 600000, 'duration_minutes' => 60,
                'description' => 'Penambahan protein.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => 'Basic Ample Care', 'price' => 600000, 'duration_minutes' => 60,
                'description' => 'Ampul basic.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => 'Mucota Clinic Small', 'price' => 1000000, 'duration_minutes' => 75,
                'description' => 'Mucota Clinic ukuran rambut pendek.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => 'Mucota Clinic Medium', 'price' => 1300000, 'duration_minutes' => 90,
                'description' => 'Mucota Clinic ukuran rambut sedang.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => 'Mucota Clinic Large', 'price' => 1600000, 'duration_minutes' => 90,
                'description' => 'Mucota Clinic ukuran rambut panjang.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => '3x Mucota Package Small', 'price' => 2500000, 'duration_minutes' => 75,
                'description' => 'Paket 3 sesi Mucota Clinic Small.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => '3x Mucota Package Medium', 'price' => 3000000, 'duration_minutes' => 90,
                'description' => 'Paket 3 sesi Mucota Clinic Medium.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => '3x Mucota Package Large', 'price' => 3500000, 'duration_minutes' => 90,
                'description' => 'Paket 3 sesi Mucota Clinic Large.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => '5x Mucota Package Small', 'price' => 4000000, 'duration_minutes' => 75,
                'description' => 'Paket 5 sesi Mucota Clinic Small.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => '5x Mucota Package Medium', 'price' => 5000000, 'duration_minutes' => 90,
                'description' => 'Paket 5 sesi Mucota Clinic Medium.'],
            ['category' => 'Clinic Hair & Mucota', 'name' => '5x Mucota Package Large', 'price' => 6000000, 'duration_minutes' => 90,
                'description' => 'Paket 5 sesi Mucota Clinic Large.'],

            // 6. SCALP CARE
            ['category' => 'Scalp Care', 'name' => 'Basic Scaling', 'price' => 500000, 'duration_minutes' => 60,
                'description' => 'Membersihkan kapalan lama dan sisa buangan di atas kulit kepala.'],
            ['category' => 'Scalp Care', 'name' => 'Khusus Oily, Dry & Sensitive', 'price' => 1000000, 'duration_minutes' => 60,
                'description' => 'Sistem khusus mengontrol kulit kepala oily, dry, dan ketombe.'],
            ['category' => 'Scalp Care', 'name' => 'Khusus Ketombe, Tox & Sensitif', 'price' => 1000000, 'duration_minutes' => 75,
                'description' => 'Pemberian nutrisi kulit kepala sensitif & melonggarkan peradangan.'],
            ['category' => 'Scalp Care', 'name' => 'Khusus Kerontokan - Konsentrasi Toxin', 'price' => 1200000, 'duration_minutes' => 75,
                'description' => 'Detoks & nutrisi pencegahan kerontokan.'],
            ['category' => 'Scalp Care', 'name' => 'Khusus Kerontokan - Konsentrasi Penumbuhan', 'price' => 1500000, 'duration_minutes' => 90,
                'description' => 'Nutrisi rambut tua untuk menunda kerontokan & bantu rambut baru tumbuh kuat.'],
            ['category' => 'Scalp Care', 'name' => 'Khusus Kerontokan - Konsentrasi Penguat Rambut', 'price' => 1500000, 'duration_minutes' => 90,
                'description' => 'Penguatan akar & batang rambut.'],
            ['category' => 'Scalp Care', 'name' => 'Basic Scaling 5x', 'price' => 2500000, 'duration_minutes' => 60,
                'description' => 'Paket 5 kali perawatan basic scaling.'],
            ['category' => 'Scalp Care', 'name' => 'Basic Scaling 10x + Special Gift', 'price' => 3000000, 'duration_minutes' => 60,
                'description' => 'Paket 10 kali perawatan basic scaling + hadiah spesial.'],
            ['category' => 'Scalp Care', 'name' => 'Control Perbaikan Kulit Kepala (Ketombe & Oily)', 'price' => 1000000, 'duration_minutes' => 60,
                'description' => 'Per sesi. Paket 5x: Rp 5.000.000 (1x service + produk). Paket 10x: Rp 8.000.000 (2x service + produk).'],
            ['category' => 'Scalp Care', 'name' => 'Control Konsentrasi Kulit Kepala (Kerontokan)', 'price' => 1500000, 'duration_minutes' => 75,
                'description' => 'Per sesi. Paket 5x: Rp 7.500.000 (1x service + produk). Paket 10x: Rp 11.000.000 (2x service + produk).'],

            // 7. STYLING & CUT PACKAGE
            ['category' => 'Styling & Cut Package', 'name' => 'Basic / Blow Dry', 'price' => 200000, 'duration_minutes' => 45,
                'description' => 'Pengeringan & blow standar.'],
            ['category' => 'Styling & Cut Package', 'name' => 'Set / Wave Dry', 'price' => 300000, 'duration_minutes' => 45,
                'description' => 'Styling gelombang / curl temporary.'],
            ['category' => 'Styling & Cut Package', 'name' => 'Semi-Up Style', 'price' => 500000, 'duration_minutes' => 60,
                'description' => 'Penataan rambut setengah naik / acara santai.'],
            ['category' => 'Styling & Cut Package', 'name' => 'Up Style', 'price' => 800000, 'duration_minutes' => 90,
                'description' => 'Sanggul / penataan formal / pesta.'],
            ['category' => 'Styling & Cut Package', 'name' => 'Cut Package (4x)', 'price' => 1000000, 'duration_minutes' => 60,
                'description' => 'Paket gunting 4x. Berlaku 1 tahun, bisa ditransfer ke orang lain. Mengutamakan reservasi dahulu.'],
        ];

        foreach ($treatments as $t) {
            Treatment::create([
                'category' => $t['category'],
                'name' => $t['name'],
                'description' => $t['description'],
                'price' => $t['price'],
                'duration_minutes' => $t['duration_minutes'],
                'status' => 'aktif',
            ]);
        }
    }
}
