<?php

namespace App\Http\Controllers;

use App\Models\Event;
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


        $data = [
            'response' => $response
        ];

        return view('admin/form-response', $data);
    }
}
