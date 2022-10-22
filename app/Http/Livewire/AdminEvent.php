<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Services\EventService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminEvent extends Component {

    //TODO: tambahkan pagination
    public $filter = 'aktif';
    public $userDept;
    public $events;

    protected EventService $eventService;
    protected UserService $userService;

	public function boot(EventService $eventService, UserService $userService) {
		$this->eventService = $eventService;
		$this->userService = $userService;
	}

    public function mount() {
        $this->userDept = $this->userService->getUserDept();
        $this->events = $this->eventService->showAktif($this->userDept->id);
    }
    
    public function updatedFilter() {
        if ($this->filter === 'aktif') {
            $this->events = $this->eventService->showAktif($this->userDept->id);
        } else if ($this->filter === 'waiting') {
            $this->events = $this->eventService->showWaiting($this->userDept->id);
        } else if ($this->filter === 'pengumuman') {
            $this->events = $this->eventService->showPengumuman($this->userDept->id);
        } else if ($this->filter === 'tutup') {
            $this->events = $this->eventService->showTutup($this->userDept->id);
        } else {
            $this->events = $this->eventService->showBy('departement_id', $this->userDept->id);
        }

    }

    public function deleteEvent(int $id) {
        $this->eventService->deleteEvent($id);
    }

    public function render() {
        return view('livewire.admin.event')
            ->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
            ->section('content');
    }
}
