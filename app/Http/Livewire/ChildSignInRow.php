<?php

namespace App\Http\Livewire;

use App\Models\Children;
use Carbon\Carbon;
use Livewire\Component;

class ChildSignInRow extends Component
{
    public $child;
    public $isSignedIn;
    public $lastPayment;

    public function mount($childId) {
        $this->child = Children::with(['payments', 'parents', 'signins'])->find($childId);
        $lastSignedIn = $this->child->signins->sortBy('signed_in')->last()->signed_in;
        $lastSignedOut = $this->child->signins->sortBy('signed_out')->last()->signed_out;
        $this->lastPayment = $this->child->payments->last();
        $lastSignedInDate   = Carbon::createFromTimestampMsUTC($lastSignedIn);
        $lastSignedOutDate  = Carbon::createFromTimestampMsUTC($lastSignedOut);
        $this->isSignedIn = ($lastSignedInDate->gte($lastSignedOutDate));
    }
    public function render()
    {
        return view('livewire.child-sign-in-row');
    }
}
