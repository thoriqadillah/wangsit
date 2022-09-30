<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    protected EventService $event;

    public function __construct(EventService $eventService)
    {
        $this->event = $eventService;
    }

    public function index()
    {
        $this->event->showEvent();
    }


    public function addEvent(Request $request)
    {

        $validated = $request->validate([
            'departement_id' => 'required',
            'slug' => 'required',
            'name' => 'required',
            'deskripsi' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'spreadsheet_url' => 'required'
        ], [
            'required' => ':attribute wajib diisi'
        ]);

        $event = $this->event->addEvent($validated);
        if ($event) {
            // do something
            return redirect('event')->with('status', 'Event berhasil didaftarkan');
        }

        // else do something
        return redirect('event')->with('status', 'Event gagal didaftarkan');
    }



    public function updateEvent(Request $request, int $id)
    {

        $validate = $request->validate([
            'departement_id' => 'required|max:255',
            'slug' => 'required',
            'name' => 'required',
            'deskripsi' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'spreadsheet_url' => 'required'
        ]);

        $updEvent = $this->event->updateEvent($validate, $id);
        if ($updEvent) {
            return redirect()->back()->with('status', 'Event berhasil diupdate');
        }

        // else do something
        return redirect()->back()->with('status', 'Event gagal diupdate')->withInput();
    }

    public function deleteEvent(int $id)
    {
        $this->event->deleteEvent($id);
    }

    public function showParticipants()
    {
        $this->event->showParticipants(1);
    }
}
