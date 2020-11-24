<?php namespace App\Http\Livewire\Provider;

use App\Models\Children;
use Livewire\Component;

class ChildCard extends Component
{
    public $child;
    public $childId;
    public $displayChildCardClass;
    public $circleChildCardBodyShowHide;

    public $childrenGuardians = [];
    public $childGuardians;
    public $guardiansOfChildIds = [];
    public $addGuardianId = 0;


    public function mount($childId) {
        $this->childId = $childId;
        $this->child = Children::with('parents')->find($this->childId);
        foreach($this->child->parents as $guardian) {
            $this->childGuardians .= " ; ".$guardian->last_name.",".$guardian->first_name;
        }
        $this->displayChildCardClass = 'hide';
        $this->circleChildCardBodyShowHide = 'arrow_circle_down';
    }


    public function render()
    {
        return view('livewire.provider.child-card');
    }


    public function flipChildCard()
    {
        if ($this->displayChildCardClass === 'hide') {
            $this->displayChildCardClass       = '';
            $this->circleChildCardBodyShowHide = 'arrow_circle_up';
        } else {
            $this->displayChildCardClass       = 'hide';
            $this->circleChildCardBodyShowHide = 'arrow_circle_down';
        }
    }


    protected function updatedChildId($id) {
        $this->childId = $id;
    }
}
