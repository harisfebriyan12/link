<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get cards count for chart
        $cardsCount = Card::count();

        // Get visitor count
        $visitorCount = cache()->get('visitor_count', 1234);

        // Check if search query is present
        $search = $request->input('search');

        if ($search) {
            // Filter cards by search term in title or description
            $cards = Card::where('judul', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%')
                ->latest()
                ->paginate(1); // Gunakan paginate alih-alih limit()->get()
        } else {
            // Get cards with pagination
            $cards = Card::latest()->paginate(1); // Gunakan paginate alih-alih limit(5)->get()
        }

        return view('home', compact('cardsCount', 'visitorCount', 'cards'));
    }
}
