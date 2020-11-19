<?php

namespace App\Http\Livewire;

use App\Models\Children;
use Livewire\Component;

class DaycareSignIn extends Component
{
    public $childrenIds;

    public function mount() {
        $this->childrenIds = Children::pluck('id');
    }

    public function render()
    {
        return view('livewire.daycare-sign-in');
    }
}
