<?php namespace App\Http\Livewire\Provider;

use App\Models\Children;
use App\Models\Parents;
use Livewire\Component;

class NewChildCard extends Component
{
    public $potentialGuardians;
    public $guardians = '';
    public $addGuardianId;
    public $guardiansOfChildIds = [];
    public $guardiansOfChild;
    public $circleNewChildCardBodyShowHide;
    public $displayNewChildCardClass;
    public $allowNewChildAdd;
    public $newChildFirstName;
    public $newChildLastName;

    public function mount() {
        $this->potentialGuardians   = Parents::orderBy('id')->get();
        $this->circleNewChildCardBodyShowHide = 'add_circle_outline';
        $this->displayNewChildCardClass = 'hide';
        $this->allowNewChildAdd = 'disabled';
    }


    public function render()
    {
        return view('livewire.provider.new-child-card');
    }


    public function guardianAdded() {
        if($this->addGuardianId != 0) {
            if ( ! empty($this->guardiansOfChild)) {
                $this->guardiansOfChildIds = [];
                foreach ($this->guardiansOfChild as $parent) {
                    $this->guardiansOfChildIds[] = $parent->id;
                }
            }
            if ( ! in_array($this->addGuardianId, $this->guardiansOfChildIds)) {
                $this->guardiansOfChildIds[] = $this->addGuardianId;
                $this->guardiansOfChild      = Parents::whereIn('id', $this->guardiansOfChildIds)->get();
            }
            $this->potentialGuardians = Parents::whereNotIn('id', $this->guardiansOfChildIds)->get();
        }
    }


    public function removeGuardianId($id) {
        if(($key = array_search($id, $this->guardiansOfChildIds)) !== false) {
            unset($this->guardiansOfChildIds[$key]);
        }

        $this->guardiansOfChild = Parents::whereIn('id', $this->guardiansOfChildIds)->get();
        $this->potentialGuardians = Parents::whereNotIn('id', $this->guardiansOfChildIds)->get();
    }


    public function flipNewChildCard()
    {
        $this->displayNewChildCardClass = ($this->displayNewChildCardClass === 'hide') ? '' : 'hide';
        $this->circleNewChildCardBodyShowHide = ($this->displayNewChildCardClass === 'hide') ? 'add_circle_outline' : 'arrow_circle_up';
    }


    public function updatedNewChildFirstName($value) {
        $this->allowNewChildAdd = (empty($value) || empty($this->newChildLastName)) ? 'disabled' : '';
    }


    public function updatedNewChildLastName($value) {
        $this->allowNewChildAdd = (empty($this->newChildFirstName) || empty($value)) ? 'disabled' : '';
    }


    public function addChild() {
        if(! empty($this->newChildFirstName) && ! empty($this->newChildLastName)) {
            $newChild = new Children();
            $newChild->first_name = $this->newChildFirstName;
            $newChild->last_name = $this->newChildLastName;
            $newChild->save();

            if(! empty($this->guardiansOfChild)) {
                foreach($this->guardiansOfChild as $guardian) {
                    Parents::find($guardian->id)->children()->attach([$newChild->id]);
                }
            }
        }
    }


    protected function updatedAddGuardianId($id) {
        $this->addGuardianId = $id;
        $this->guardianAdded();
    }
}
