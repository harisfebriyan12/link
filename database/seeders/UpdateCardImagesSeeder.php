
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateCardImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update first card with existing image
        DB::table('cards')->where('judul', 'Wisata Alam Bukit Mutiara')->update([
            'gambar' => 'cards/S55SOXTncyYyWdw3SUA5JOBGc5Of3oPiDMh8EEQz.jpg',
        ]);

        // Update second card with existing image
        DB::table('cards')->where('judul', 'Kuliner Khas Karawang')->update([
            'gambar' => 'cards/y0pRnLSkRc5uEiQUC4jArjaEwrHv848VOzhE6VMN.jpg',
        ]);

        // Set gambar to null for other cards to avoid broken images
        $otherCards = [
            'Sejarah Kota Karawang',
            'Event Tahunan Karawang',
            'Pendidikan di Karawang',
            'Transportasi Umum',
            'Pusat Perbelanjaan',
            'Kesehatan dan Rumah Sakit',
            'Olahraga dan Rekreasi',
            'Penginapan dan Hotel',
        ];

        foreach ($otherCards as $judul) {
            DB::table('cards')->where('judul', $judul)->update([
                'gambar' => null,
            ]);
        }
    }
}
