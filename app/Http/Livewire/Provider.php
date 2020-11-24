<?php

namespace App\Http\Livewire;

use App\Models\Children;
use Livewire\Component;

class Provider extends Component
{
    public $children;
    public $childrenIds;
    public $displayClass;


    public $listeners = ['showMain', 'hideMain'];

    public function mount() {
        $this->displayClass = 'hide';
        $this->children             = Children::with(['payments', 'parents'])->get();


    }

    public function render()
    {
        return view('livewire.provider');
    }

    public function showMain() {
        $this->displayClass = 'show';
    }

    public function hideMain() {
        $this->displayClass = 'hide';
    }
}
