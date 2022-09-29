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



    //Buat admin
    public function addEvent(Request $request)
    {
        $this->event->addEvent($request);
    }

    public function updateEvent(Request $request, int $id)
    {

        $this->event->updateEvent($request, $id);
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
