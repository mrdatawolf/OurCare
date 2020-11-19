<?php

namespace App\Http\Livewire;

use App\Models\Children;
use App\Models\Parents;
use Livewire\Component;

class Provider extends Component
{
    public $children;
    public $child;
    public $childId;
    public $childrenIds;
    public $guardians = [];
    public $potentialGuardians;
    public $childrenGuardians = [];
    public $guardiansOfChild;
    public $guardiansOfChildIds = [];
    public $addGuardianId = 0;

    public function mount() {
        $this->potentialGuardians = Parents::orderBy('id')->get();
        $this->children = Children::with(['payments', 'parents'])->get();
        foreach($this->children as $child) {
            foreach($child->parents as $parents) {
                $this->childrenGuardians[$child->id][] = $parents->last_name.",".$parents->first_name;
            }
        }
    }

    public function render()
    {
        return view('livewire.provider');
    }

    protected function updatedChildId($id) {
        $this->childId = $id;
    }

    protected function updatedAddGuardianId($id) {
        $this->addGuardianId = $id;
        $this->guardianAdded();
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

}
