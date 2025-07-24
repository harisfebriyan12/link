<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get cards count for chart (example: count of cards)
        $cardsCount = Card::count();

        // Get visitor count - assuming a 'visitors' table or similar exists
        // For now, simulate visitor count as a static number or from a cache
        $visitorCount = cache()->get('visitor_count', 1234);

        // Check if search query is present
        $search = $request->input('search');

        if ($search) {
            // Filter cards by search term in title or description
            $cards = Card::where('judul', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%')
                ->latest()
                ->limit(5)
                ->get();
        } else {
            // Get latest 5 cards for display on home page
            $cards = Card::latest()->limit(5)->get();
        }

        return view('home', compact('cardsCount', 'visitorCount', 'cards'));
    }
}
