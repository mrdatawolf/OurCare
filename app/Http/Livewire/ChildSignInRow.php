<?php

namespace App\Http\Livewire;

use App\Models\Children;
use Livewire\Component;

class ChildSignInRow extends Component
{
    public $child;

    public function mount($childId) {
        $this->child = Children::with(['payments', 'parents'])->find($childId);
    }
    public function render()
    {
        return view('livewire.child-sign-in-row');
    }
}
