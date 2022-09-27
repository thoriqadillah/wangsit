<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Foundation\Console\EventMakeCommand;

class EventService
{

    // user
    public function showEvent()
    {
        $event = Event::where('end_date', ">", Carbon::now())->get();
        // return $event
        for ($i = 0; $i < sizeof($event); $i++) {
            echo ($event[$i]->name);
        }
    }



    //Buat admin

    public function addEvent(int $deptId, string $slug, string $name, string $desc, string $start, string $end, string $thumbnail, string $url)
    {
        // validasi input dulu sebelum melakukan insert
        // $validated = $request->validate([
        //     'departement_name' => 'required|unique:posts|max:255',
        //     'name' => 'required',
        //      ...
        // ]);

        $event = new Event();
        $event->departement_id = $deptId;
        $event->slug = $slug;
        $event->name = $name;
        $event->deskripsi = $desc;
        $event->start_date = $start;
        $event->end_date = $end;
        $event->thumbnail = $thumbnail;
        $event->spreadsheet_url = $url;

        $event->save();
    }

    public function updateEvent(int $id, int $deptId, string $slug, string $name, string $desc, string $start, string $end, string $thumbnail, string $url)
    {
        $event = Event::findOrFail($id);
        //manual
        $event->departement_id = $deptId;
        $event->slug = $slug;
        $event->name = $name;
        $event->deskripsi = $desc;
        $event->start_date = $start;
        $event->end_date = $end;
        $event->thumbnail = $thumbnail;
        $event->spreadsheet_url = $url;

        $event->update();

        //Harusnya ini nanti
        // $event->update($request->all());
        // return redirect('/Event');
    }

    public function deleteEvent(int $id)
    {
        $event = Event::find($id);
        $event->delete();
        echo ('berhasil');
    }

    public function showParticipants(int $eventId)
    {
        $participants = Participant::where('event_id', $eventId)->get();

        for ($i = 0; $i < sizeof($participants); $i++) {
            echo ($participants[$i]->name);
        }

        // dd($participants[1]->name);
    }
}
