<?php

namespace App\Http\Livewire;

use App\Models\Children;
use App\Models\Signins;
use Illuminate\Support\Collection;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;

class ChildCalendar extends LivewireCalendar
{
    public function events(): Collection
    {
        $signinData = [];
        $signins    = Signins::with('children')->get();
        foreach ($signins as $signin) {
            $signedIn     = Carbon::createFromTimestampMsUTC($signin->signed_in);
            $signedOut    = Carbon::createFromTimestampMsUTC($signin->signed_out);
            $child        = Children::find($signin->children_id);
            $totalHours   = $signedIn->diffInHours($signedOut);
            $id           = $signin->id;
            if($totalHours < 24) {
                $numberToShow = $totalHours;
                $wording      = 'hours';
            } elseif($totalHours < 720) {
                $numberToShow = floor($totalHours / 24);
                $wording      = 'days';
            } else {
                $numberToShow = floor($totalHours / 24 / 365);
                $wording      = 'years';
            }

            $signinData[] = [
                'id'          => $id,
                'title'       => $child->first_name.' '.$child->last_name,
                'description' => 'Stayed for '.$numberToShow.' '.$wording.'.',
                'date'        => $signedIn
            ];
        }

        return collect($signinData);
    }
}
