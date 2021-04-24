<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CCalendar extends Component
{
    public $displayClass;
    protected $listeners = ['showMain', 'hideMain'];

    public function mount() {
        $this->displayClass = 'hide';
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
