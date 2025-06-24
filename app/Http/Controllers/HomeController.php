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

        return view('home', compact('cardsCount', 'visitorCount'));
    }
}
