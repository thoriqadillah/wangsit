<?php

namespace App\Http\Controllers;

use App\Services\EventFormResponseService;
use App\Services\EventFormService;
use App\Services\EventService;
use Illuminate\Http\Request;

class SuccessfulRegistrationController extends Controller {

    protected EventService $eventService;
    protected EventFormResponseService $eventFormResponseService;

    public function __construct(EventService $eventService, EventFormResponseService $eventFormResponseService) {
        $this->eventService = $eventService;
        $this->eventFormResponseService = $eventFormResponseService;
    }
    
    public function index(string $slug) {
        $event = $this->eventService->showBy('slug', $slug);
        if ($event->isEmpty()) return abort(404);

        $isRegistered = $this->eventFormResponseService->checkUserResponse($event[0]->id);
        if(!$isRegistered) return redirect('/event');

        return view('success');
    }
}
