<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Card::query();

    if ($request->filled('search')) {
        $query->where('judul', 'like', '%'.$request->search.'%');
    }

    // Tambahkan with untuk eager loading jika ada relasi
    $cards = $query->latest()->get();

    // Debug data - untuk testing saja, hapus setelah fix
    logger()->info('Total cards: '.$cards->count());
    logger()->info('First card: '.($cards->first() ? $cards->first()->judul : 'null'));

    return view('cards.index', compact('cards'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'required|url',
        ]);

        // Handle upload gambar dengan nama unik
        if ($request->hasFile('gambar')) {
            $filename = time().'_'.$request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('cards', $filename, 'public');
            $validated['gambar'] = $path;
        }

        Card::create($validated);

        return redirect()->route('cards.index')
               ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        return view('cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'required|url',
        ]);

        // Handle update gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($card->gambar && Storage::disk('public')->exists($card->gambar)) {
                Storage::disk('public')->delete($card->gambar);
            }
            
            $filename = time().'_'.$request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('cards', $filename, 'public');
            $validated['gambar'] = $path;
        } else {
            // Pertahankan gambar lama jika tidak diupdate
            $validated['gambar'] = $card->gambar;
        }

        $card->update($validated);

        return redirect()->route('cards.index')
               ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        // Hapus file gambar terkait
        if ($card->gambar && Storage::disk('public')->exists($card->gambar)) {
            Storage::disk('public')->delete($card->gambar);
        }
        
        $card->delete();

        return redirect()->route('cards.index')
               ->with('success', 'Data berhasil dihapus.');
    }
}