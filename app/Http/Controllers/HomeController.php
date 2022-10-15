<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller {
    
    protected UserService $userService;
    protected EventService $eventService;

    public function __construct(UserService $userService, EventService $eventService) {
        $this->userService = $userService;
        $this->eventService = $eventService;
    }

    public function index() {
        $user = $this->userService->getUser();
        $birthdayUsers = $this->userService->getBirthdayUsers();
        $latestEvent = $this->eventService->getLatestEvent();

        return view('home', compact(['user', 'birthdayUsers', 'latestEvent']));
    }
}
