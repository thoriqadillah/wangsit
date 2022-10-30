<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\EventForm;
use App\Models\EventLulusStatus;
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

    public function abortIfRoot()
    {
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);
    }

    public function getResponse($slug)
    {
        $event = $this->eventResponse->getEventSlug($slug);
        $response = $this->eventResponse->getResponses($event->id);
        $head = $this->eventResponse->getHeadResponse($slug);
        $lulus = $this->eventResponse->getLulusResponse($slug);


        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);

        if (is_null($head)) return abort(404);

        $data = [
            'head' => $head,
            'response' => $response,
            'event' => $event,
            'lulus' => $lulus
        ];

        return view('admin/form-response', $data);
    }
}
