<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $cards = Card::all();
        $visitorCount = 123; // Placeholder, replace with real visitor count if available
        return view('admin.dashboard_admin', compact('cards', 'visitorCount'));
    }

    public function manageUsers()
    {
        $users = \App\Models\User::all();
        return view('admin.manage_users', compact('users'));
    }

    public function changePassword()
    {
        return view('admin.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.changePassword')->with('success', 'Password updated successfully.');
    }
}
