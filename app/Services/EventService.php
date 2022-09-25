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

    public function daftarEvent(int $eventId, string $name, string $nim, string $angkatan, string $idLine)
    {
        $participant = new Participant();

        $participant->name = $name;
        $participant->event_id = $eventId;
        $participant->nim = $nim;
        $participant->angakatan = $angkatan;
        $participant->idLine = $idLine;

        $participant->save();
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
