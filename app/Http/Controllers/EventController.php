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
    public function addEvent()
    {
        // input diambil dari value form select untuk departement id
        // input masih dummy
        $deptIds = Departement::where('id', 1)->first();
        $deptIdy = $deptIds->id;

        $this->event->addEvent($deptIdy, 'event1', 'Event 1', 'Event mengenai angka 1', '2022-12-01', '2022-12-10', 'satu.jpg', 'satu.com');
    }

    public function updateEvent()
    {
        // input diambil dari value form select untuk departement id
        // input masih dummy
        $deptIds = Departement::where('id', 1)->first();
        $deptIdy = $deptIds->id;
        $this->event->updateEvent(1, $deptIdy, 'event1.1', 'Event 1', 'Event mengenai angka 1', '2022-12-01', '2022-12-10', 'satu.jpg', 'satu.com');
    }

    public function deleteEvent(int $id)
    {
        //parameter nya $id diambil dari route
        $this->event->deleteEvent($id);
    }

    public function showParticipants()
    {
        $this->event->showParticipants(1);
    }
}
