<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Services\EventService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminEvent extends Component {

    use WithPagination;
    //TODO: tambahkan pagination
    public $perPage = 20;

    public $filter = 'semua';
    public $userDept;

    protected EventService $eventService;
    protected UserService $userService;

	public function boot(EventService $eventService, UserService $userService) {
		$this->eventService = $eventService;
		$this->userService = $userService;
	}

    public function mount() {
        $this->userDept = $this->userService->getUserDept();
    }
    
    public function deleteEvent(int $id) {
        $this->eventService->deleteEvent($id);
        redirect()->to('/admin/event')->with('success', 'Event berhasil dihapus');
    }

    public function render() {
        $data = [
            'events' => $this->eventService->showByFilter($this->filter, $this->userDept->id, $this->perPage)
        ];
        return view('livewire.admin.event', $data)
            ->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
            ->section('content');
    }
}
