<?php

namespace App\Http\Controllers;

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
        dd($this->event->showEvent());
    }



    //Buat admin
    public function showParticipants()
    {
        $this->event->showParticipants(1);
    }
}
