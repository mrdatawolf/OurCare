<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PinCard extends Component
{

    public $pinCode;
    public $showMain;
    public $errorClass;
    public $mainClass;
    public $pinClass;
    public $listeners = ['pinCodeCheck'];

    public function mount() {
        $this->pinCode = null;
        $this->showMain = false;
        $this->errorClass = '';
        $this->mainClass = 'hide';
        $this->pinClass = '';
    }

    public function render()
    {
        return view('livewire.pin-card');
    }

    public function lock($errorClass = '') {
        $this->errorClass = '';
        $this->pinClass = '';
        $this->mainClass = 'hide';
        $this->emit('hideMain');
        $this->emit('lock');
        $this->showMain = false;
        $this->errorClass = $errorClass;
    }

    public function pinCodeCheck($value) {
        $this->errorClass = '';
        $this->pinClass = '';
        $this->mainClass = '';

        if (Auth::user()->isValidPinCode($value)) {
            $this->emit('showMain');
            $this->showMain = true;
            $this->pinClass = 'hide';
        } else {

            $this->lock('pin-login__text--error');
        }
    }
}
