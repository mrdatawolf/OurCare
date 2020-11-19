<?php

namespace App\Http\Livewire;

use App\Models\Children;
use Livewire\Component;
use \Carbon\Carbon;

class Billing extends Component
{
    public $activeMonth;
    public $activeMonthDifference;
    public $days;
    public $billedAt;
    public $totalDue;
    public $isPaid;
    public $firstParent;
    public $secondParent;
    public $firstParentName;
    public $secondParentName;
    public $children;
    public $child;
    public $childName;

    public function mount() {
        $this->children = Children::orderBy('last_name')->get();
        $this->activeMonth = Carbon::now();
        $this->activeMonthDifference = 0;
        $this->gatherChild();
        $this->gatherParents();
        $this->gatherPayments();
        $this->gatherBillingRate();
        $this->calculateTotalDue();
        $this->markUnPaid();
    }

    public function render()
    {
        return view('livewire.billing');
    }

    public function updatedDays() {
        $this->calculateTotalDue();
    }

    public function updatedAmountPerDay() {
        $this->calculateTotalDue();
    }

    public function updatedChildName($id) {
        $this->child = Children::find($id);
        $this->resetForChange();
        $this->gatherParents();
        $this->gatherPayments();
        $this->gatherBillingRate();
        $this->calculateTotalDue();
        $this->markUnPaid();
    }

    public function gatherChild() {
        $this->child = Children::orderBy('last_name')->with(['parents', 'payments', 'billingRate'])->first();
        $this->childName = $this->child->first_name . " " . $this->child->last_name;
    }

    public function gatherParents() {
        $parentNumber = 1;
        foreach($this->child->parents as $parent) {
            if($parentNumber === 1) {
                $this->firstParent      = $parent;
                $this->firstParentName  = $this->firstParent->last_name.",".$this->firstParent->first_name;
                $parentNumber = 2;
            } else {
                $this->secondParent     = $parent;
                $this->secondParentName = $this->secondParent->last_name.",".$this->secondParent->first_name;
            }
        }
    }

    public function resetForChange() {
        $this->days = 0;
        $this->totalDue = 0;
        $this->billedAt = 0;
        $this->firstParent = null;
        $this->secondParent = null;
        $this->firstParentName = '';
        $this->secondParentName = '';
    }

    public function gatherPayments() {
        $days = $this->days;
        foreach($this->child->payments as $payment) {
            if($payment->paid == 'false') {
                $dueDate = Carbon::createFromTimestampMsUTC($payment->due_date);
                if ($dueDate->isBetween($this->activeMonth->startOfMonth()->toDateString(), $this->activeMonth->endOfMonth()->toDateString())) {
                    $days++;
                }
            }
        }
        $this->days = $days;
    }

    public function gatherBillingRate() {
        $this->billedAt = $this->child->billingRate->rate;
    }

    public function calculateTotalDue() {
        $this->totalDue = $this->days * $this->billedAt;
    }

    public function decreaseMonth() {
        $this->activeMonthDifference--;
        $this->updateMonth();
    }

    public function increaseMonth() {
        $this->activeMonthDifference++;
        $this->updateMonth();
    }

    public function markPaid() {
        $this->isPaid = true;
    }

    public function markUnPaid() {
        $this->isPaid = false;
    }


    public function updateMonth() {
        $this->activeMonth = Carbon::now()->addMonths($this->activeMonthDifference);
        $this->resetForChange();
        $this->gatherPayments();
        $this->gatherBillingRate();
        $this->calculateTotalDue();
        $this->markUnPaid();
    }
}
