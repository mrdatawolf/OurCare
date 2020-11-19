<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PinCard extends Component
{

    public $pinCode;
    public $showMain;

    public function mount() {
        $this->pinCode = null;
        $this->showMain = false;
    }

    public function render()
    {
        return view('livewire.pin-card');
    }

    public function pinCodeCheck($value) {
        $userPinCode = 1234;

    }
}
