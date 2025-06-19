<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $cards = Card::all();
        return view('admin.dashboard', compact('cards'));
    }
}
