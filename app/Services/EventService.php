<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Participant;

class EventService
{
    public function showEvent()
    {
        $event = Event::all();
        dd($event);
    }


    //Buat admin
    public function showParticipants(int $eventId)
    {
        $participants = Participant::where('event_id', $eventId)->get();

        for ($i = 0; $i < sizeof($participants); $i++) {
            echo ($participants[$i]->name);
        }

        // dd($participants[1]->name);
    }
}
