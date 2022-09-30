<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Departement;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Foundation\Console\EventMakeCommand;
use Illuminate\Database\Eloquent\Collection;

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

    public function addEvent(array $eventData): Collection
    {

        return Event::create([
            'departement_id' => $eventData['departement_id'],
            'slug' => $eventData['slug'],
            'name' => $eventData['name'],
            'deskripsi' => $eventData['deskripsi'],
            'start_date' => $eventData['start_date'],
            'end_date' => $eventData['end_date'],
            'spreadsheet_url' => $eventData['spreadsheet_url']
        ]);
        // return redirect()->route('event');

    }

    public function updateEvent(array $eventData, int $id): Collection
    {

        return Event::where('id', $id)->update([
            'departement_id' => $eventData['departement_id'],
            'slug' => $eventData['slug'],
            'name' => $eventData['name'],
            'deskripsi' => $eventData['deskripsi'],
            'start_date' => $eventData['start_date'],
            'end_date' => $eventData['end_date'],
            'spreadsheet_url' => $eventData['spreadsheet_url']
        ]);

        // $event = Event::findOrFail($id);

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
