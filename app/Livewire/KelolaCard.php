<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Card;

class KelolaCard extends Component
{
    public function render()
    {
        return view('livewire.kelola-card', [
            'cards' => Card::latest()->get()
        ]);
    }
}
