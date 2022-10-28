<?php

namespace App\Http\Controllers;

use App\Services\AnnouncementService;
use App\Services\EventService;
use App\Services\GraduationService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnnouncementController extends Controller {

    public $userDept;

    protected AnnouncementService $announcementService;
    protected EventService $eventService;
    protected UserService $userService;
    
    public function __construct(AnnouncementService $announcementService, EventService $eventService, UserService $userService) {
        $this->announcementService = $announcementService;
        $this->eventService = $eventService;
        $this->userService = $userService;
    }

    public function index(string $slug) {
        $event = $this->eventService->showBy('slug', $slug);
        if ($event->isEmpty()) return abort(404);

        if ($event[0]->tgl_buka_pengumuman > Carbon::now()) return abort(404);

        $data = $this->announcementService->checkUser($event[0]->id);
        if (!$data) return abort(404);

        $isGraduated = $data->status_lulus;
        return view('announcement', [
            'isGraduated' => $isGraduated,
            'event' => $event[0]
        ]);
    }
    
}
