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
        $signins = Signins::with('children')->get();
        foreach ($signins as $signin) {
            $signedIn = Carbon::createFromTimestamp($signin->signed_in);
            $signedOut = Carbon::createFromTimestamp($signin->signed_out);
            $child      = Children::find($signin->children_id);
            $totalHours = $signedIn->diffInHours($signedOut);
            $id         = $signin->id;

            $signinData[] = [
                'id'          => $id,
                'title'       => $child->first_name.' '.$child->last_name,
                'description' => 'Stayed for '.$totalHours.' hours.',
                'date'        => $signedIn
            ];

        }

        return collect($signinData);
    }
}
