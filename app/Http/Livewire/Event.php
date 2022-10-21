<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Models\Event as ModelsEvent;
use App\Services\EventService;
use Carbon\Carbon;
use Livewire\Component;

class Event extends Component {

	//TODO: tambahkan pagination
	public $filter = 'aktif';
	public $departements;
	public $deptId = 0;
	public $events;

	protected EventService $eventService;

	public function boot(EventService $eventService) {
		$this->eventService = $eventService;
	}

	public function mount() {
		$this->departements = Departement::all();
		$this->events = $this->eventService->showAktif($this->deptId);
	}

	public function setDept(int $deptId = 0) {
		$this->deptId = $deptId;

		$this->events = $this->filter == 'aktif' 
			? $this->eventService->showAktif($this->deptId)
			: $this->eventService->showPengumuman($this->deptId);
	}

	public function updatedFilter() {
		$this->events = $this->filter == 'aktif' 
			? $this->eventService->showAktif($this->deptId)
			: $this->eventService->showPengumuman($this->deptId);
	}

	public function render() {
		return view('livewire.event')
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}
