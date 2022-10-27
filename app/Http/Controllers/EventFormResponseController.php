<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\EventForm;
use Illuminate\Http\Request;
use App\Services\EventFormResponseService;
use App\Services\UserService;

class EventFormResponseController extends Controller
{
    public $userDept;
    
    protected EventFormResponseService $eventResponse;
    protected UserService $userService;

    public function __construct(EventFormResponseService $eventResponse, UserService $userService)
    {
        $this->eventResponse = $eventResponse;
        $this->userService = $userService;
    }

    public function abortIfRoot() {
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);
    }

    public function getResponse($slug)
    {
        $this->abortIfRoot();
        $event = Event::where('slug', $slug)->first();
        $response = $this->eventResponse->getResponses($event->id);
        $head = EventForm::where('event_id', $event->id)->first();

        if (is_null($head)) return abort(404);

        $data = [
            'head' => $head,
            'response' => $response,
            'event' => $event
        ];

        return view('admin/form-response', $data);
    }
}
