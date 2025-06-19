<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = [
            [
                'judul' => 'Wisata Alam Bukit Mutiara',
                'deskripsi' => 'Nikmati keindahan alam Bukit Mutiara dengan pemandangan yang memukau dan udara segar.',
                'gambar' => 'cards/sample-image-1.jpg',
                'link' => 'https://example.com/wisata-bukit-mutiara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kuliner Khas Karawang',
                'deskripsi' => 'Cicipi berbagai kuliner khas Karawang yang menggugah selera dan kaya rasa.',
                'gambar' => 'cards/sample-image-2.jpg',
                'link' => 'https://example.com/kuliner-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Sejarah Kota Karawang',
                'deskripsi' => 'Pelajari sejarah dan budaya Kota Karawang yang kaya dan beragam.',
                'gambar' => 'cards/sample-image-3.jpg',
                'link' => 'https://example.com/sejarah-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Event Tahunan Karawang',
                'deskripsi' => 'Ikuti berbagai event tahunan yang diselenggarakan di Karawang dengan berbagai kegiatan menarik.',
                'gambar' => 'cards/sample-image-4.jpg',
                'link' => 'https://example.com/event-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pendidikan di Karawang',
                'deskripsi' => 'Informasi tentang institusi pendidikan dan program belajar di Karawang.',
                'gambar' => 'cards/sample-image-5.jpg',
                'link' => 'https://example.com/pendidikan-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Transportasi Umum',
                'deskripsi' => 'Panduan transportasi umum yang tersedia di Karawang untuk memudahkan mobilitas Anda.',
                'gambar' => 'cards/sample-image-6.jpg',
                'link' => 'https://example.com/transportasi-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pusat Perbelanjaan',
                'deskripsi' => 'Temukan pusat perbelanjaan terbaik di Karawang dengan berbagai produk dan promo menarik.',
                'gambar' => 'cards/sample-image-7.jpg',
                'link' => 'https://example.com/perbelanjaan-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kesehatan dan Rumah Sakit',
                'deskripsi' => 'Informasi fasilitas kesehatan dan rumah sakit yang ada di Karawang.',
                'gambar' => 'cards/sample-image-8.jpg',
                'link' => 'https://example.com/kesehatan-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Olahraga dan Rekreasi',
                'deskripsi' => 'Tempat olahraga dan rekreasi yang bisa Anda kunjungi di Karawang.',
                'gambar' => 'cards/sample-image-9.jpg',
                'link' => 'https://example.com/olahraga-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Penginapan dan Hotel',
                'deskripsi' => 'Daftar penginapan dan hotel terbaik untuk kenyamanan Anda selama di Karawang.',
                'gambar' => 'cards/sample-image-10.jpg',
                'link' => 'https://example.com/hotel-karawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('cards')->truncate();
        DB::table('cards')->insert($cards);
    }
}
