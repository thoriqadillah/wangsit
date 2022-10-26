<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\EventForm;
use Illuminate\Http\Request;
use App\Services\EventFormResponseService;

class EventFormResponseController extends Controller
{
    protected EventFormResponseService $eventResponse;

    public function __construct(EventFormResponseService $eventResponse)
    {
        $this->eventResponse = $eventResponse;
    }

    public function getResponse($slug)
    {
        $event = Event::where('slug', $slug)->first();
        $response = $this->eventResponse->getResponses($event->id);
        $head = EventForm::where('event_id', $event->id)->first();

        $data = [
            'head' => $head,
            'response' => $response
        ];

        if (is_null($head)) {
            return abort(404);
        } else
            return view('admin/form-response', $data);
    }
}
