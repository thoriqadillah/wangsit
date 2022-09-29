<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Departement;
use App\Models\Participant;
use Illuminate\Http\Request;
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

    public function addEvent(Request $request)
    {
        // validasi input dulu sebelum melakukan insert
        $request->validate([
            'departement_id' => 'required|max:255',
            'slug' => 'required',
            'name' => 'required',
            'deskripsi' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'spreadsheet_url' => 'required'
        ]);

        // $deptName = $request->input('departement_name');

        // $getDeptId = Departement::where('departement', $deptName)->value('id');
        // // $deptId = $getDeptId->id;


        Event::create([
            'departement_id' => $request->input('departement_id'),
            'slug' => $request->input('slug'),
            'name' => $request->input('name'),
            'deskripsi' => $request->input('deskripsi'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'spreadsheet_url' => $request->input('spreadsheet_url')
        ]);
        return redirect()->route('event');
    }

    public function updateEvent(Request $request, int $id)
    {

        $request->validate([
            'departement_id' => 'required|max:255',
            'slug' => 'required',
            'name' => 'required',
            'deskripsi' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'spreadsheet_url' => 'required'
        ]);

        $event = Event::findOrFail($id);

        $event->update($request->all());
        return redirect('/Event');
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
