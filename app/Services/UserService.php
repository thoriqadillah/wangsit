<?php

namespace App\Services;

use App\Models\Participant;

class UserService
{
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
}
