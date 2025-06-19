<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLinksToCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing cards with example links
        $cards = DB::table('cards')->get();

        foreach ($cards as $card) {
            // Only update if link is empty or null
            if (empty($card->link)) {
                DB::table('cards')
                    ->where('id', $card->id)
                    ->update([
                        'link' => 'https://example.com/card/' . $card->id,
                    ]);
            }
        }
    }
}
