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

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $cards = $query->limit(10)->get();

        return view('data.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|max:2048',
            'link' => 'required|url',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('data', 'public');
            $validated['gambar'] = $path;
        }

        Card::create($validated);

        return redirect()->route('data.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        return view('data.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'link' => 'required|url',
        ]);

        if ($request->hasFile('gambar')) {
            if ($card->gambar) {
                Storage::disk('public')->delete($card->gambar);
            }
            $path = $request->file('gambar')->store('data', 'public');
            $validated['gambar'] = $path;
        } else {
            $validated['gambar'] = $card->gambar;
        }

        $card->update($validated);

        return redirect()->route('data.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $data)
    {
        if ($card->gambar) {
            Storage::disk('public')->delete($data->gambar);
        }
        $data->delete();

        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus.');
    }
}
