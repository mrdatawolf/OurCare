<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CCalendar extends Component
{
    public $displayClass;
    public $listeners = ['showMain', 'hideMain'];

    public function mount() {
        $this->displayClass = 'show';
    }

    public function render()
    {
        return view('livewire.c-calendar');
    }

    public function showMain() {
        $this->displayClass = 'show';
    }

    public function hideMain() {
        $this->displayClass = 'hide';
    }
}
