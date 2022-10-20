<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Services\EventService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminEvent extends Component {

    //TODO: tambahkan pagination
    public $userDept;

    protected EventService $eventService;

	public function boot(EventService $eventService) {
		$this->eventService = $eventService;
	}

    public function mount() {
        $deptId = Auth::user()->admin->departement_id;
        $this->userDept = Departement::find($deptId);
    }

    //TODO: filter berdasarkan dropdown

    public function render() {
        return view('livewire.admin.event')
            ->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
            ->section('content');
    }
}
