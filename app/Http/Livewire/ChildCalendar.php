<?php

namespace App\Http\Livewire;

use App\Models\Children;
use App\Models\Signins;
use Illuminate\Support\Collection;
use Asantibanez\LivewireCalendar\LivewireCalendar;

class ChildCalendar extends LivewireCalendar
{
    public function events(): Collection
    {
        $signinData = [];
        $signins    = Signins::with('children')->get();
        $childrenThatStayed = [];

        foreach ($signins as $signin) {
            $child        = Children::find($signin->children_id);
            $totalHours   = $signin->signed_in->diffInHours($signin->signed_out);
            $id           = $signin->id;
            if($totalHours < 24) {
                $numberToShow = $totalHours;
                $wording      = 'hrs';
            } elseif($totalHours < 720) {
                $numberToShow = floor($totalHours / 24);
                $wording      = 'days';
            } else {
                $numberToShow = floor($totalHours / 24 / 365);
                $wording      = 'yrs';
            }
            $childrenThatStayed[$signin->signed_in->toDateString()][$signin->children_id] =  $child->first_name.' '.$child->last_name;

        }
        foreach($childrenThatStayed as $date => $childData) {
            foreach($childData as $childId => $title) {
                $signinData[] = [
                    'id'          => $childId,
                    'title'       => $title,
                    'date'        => $date,
                    'description' => ''
                ];
            }
        }

        return collect($signinData);
    }
}
