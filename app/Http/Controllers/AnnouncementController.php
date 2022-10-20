<?php

namespace App\Http\Controllers;

use App\Services\AnnouncementService;
use App\Services\EventService;
use App\Services\GraduationService;
use Illuminate\Http\Request;

class AnnouncementController extends Controller {

    protected AnnouncementService $announcementService;
    protected EventService $eventService;

    public function __construct(AnnouncementService $announcementService, EventService $eventService) {
        $this->announcementService = $announcementService;
        $this->eventService = $eventService;
    }

    public function index(string $slug) {
        $event = $this->eventService->showBy('slug', $slug);
        if ($event->isEmpty()) return abort(404);

        $isGraduated = $this->announcementService->checkUser($event[0]->id)->status_lulus;
        return view('registration.announcement', [
            'isGraduated' => $isGraduated,
            'event' => $event[0]
        ]);
    }
    
}
