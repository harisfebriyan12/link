<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Fungsi untuk dashboard utama dengan data total cards & total users
    public function index()
    {
        $totalCards = Card::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalCards', 'totalUsers'));
    }

    // Fungsi dashboard alternatif (jika beda halaman)
public function dashboard()
{
    $cards = Card::all();
    $totalCards = $cards->count();
    $totalUsers = \App\Models\User::count();
    $visitorCount = 123; // Placeholder

    return view('admin.dashboard_admin', compact('cards', 'totalCards', 'totalUsers', 'visitorCount'));
}

    // Menampilkan halaman kelola user
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage_users', compact('users'));
    }

    // Tampilkan form ganti password
    public function changePassword()
    {
        return view('admin.change_password');
    }

    // Proses update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.changePassword')->with('success', 'Password berhasil diubah.');
    }
}
