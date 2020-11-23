<?php namespace App\Http\Livewire;

use App\Models\Children;
use App\Models\Signins;
use Carbon\Carbon;
use Livewire\Component;

class ChildSignInRow extends Component
{
    public $child;
    public $childAvatar;
    public $isSignedIn;
    public $lastPayment;
    public $displayClass;
    public $circleTypeShowHide;
    public $circleTypeSignIn;
    public $signedInClass;


    public function mount($childId)
    {
        $this->child       = Children::with(['payments', 'parents', 'signins'])->find($childId);
        $this->lastPayment = $this->child->payments->last();
        $hasSignins        = ! $this->child->signins->isEmpty();
        if ($hasSignins) {
            $lastSignedInDate      = $this->child->signins->sortBy('signed_in')->last()->signed_in;
            $lastSignedOutDate     = $this->child->signins->sortBy('signed_out')->last()->signed_out;
            $this->isSignedIn      = ($lastSignedInDate->gte($lastSignedOutDate));
        }
        $this->isSignedIn         = ($hasSignins) ? ($lastSignedInDate->gte($lastSignedOutDate)) : false;
        $this->signedInClass      = ($this->isSignedIn) ? 'child-signed-in' : 'child-signed-out';
        $this->displayClass       = 'hide';
        $this->circleTypeShowHide = 'arrow_circle_down';
        $this->circleTypeSignIn   = ($this->isSignedIn) ? 'person_remove' : 'person_add';
    }


    public function render()
    {
        return view('livewire.child-sign-in-row');
    }


    public function flipSignIn()
    {
        $this->updateSignins();
        $this->isSignedIn       = ( ! $this->isSignedIn);
        $this->circleTypeSignIn = ($this->isSignedIn) ? 'person_remove' : 'person_add';
    }


    public function flipChildCard()
    {
        if ($this->displayClass === 'hide') {
            $this->displayClass       = '';
            $this->circleTypeShowHide = 'arrow_circle_up';
        } else {
            $this->displayClass       = 'hide';
            $this->circleTypeShowHide = 'arrow_circle_down';
        }
    }


    protected function updateSignins()
    {
        $signin = new Signins();
        if ( ! $this->isSignedIn) {
            $signin->children_id = $this->child->id;
            $signin->signed_in = Carbon::now();
            $signin->save();
            $this->signedInClass = 'child-signed-in';
        } else {
            $update = $signin->where('children_id', $this->child->id)->latest('signed_in')->first();
            $update->signed_out = Carbon::now();
            $update->save();
            $this->signedInClass = 'child-signed-out';
        }
    }
}
