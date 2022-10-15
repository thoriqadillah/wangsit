<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Services\EventService;
use Carbon\Carbon;
use Livewire\Component;

class Event extends Component {

	//TODO: tambahkan pagination
	public $departements;
	public $events;

	protected EventService $eventService;

	public function boot(EventService $eventService) {
		$this->eventService = $eventService;
	}

	public function mount() {
		$this->departements = Departement::all();
		$this->events = $this->eventService->showEvent();
		
		$now = Carbon::now();
		foreach ($this->events as $i => $event) {
				$this->events[$i]->countdown = $now->diffInDays($event->tgl_tutup_pendaftaran);
		}
	}

	public function showEvents(int $deptId = 0) {
		if ($deptId == 0) {
			$this->events = $this->eventService->showEvent();
		} else {
			$this->events = $this->eventService->showBy('departement_id', $deptId);
		}
	}

	public function render() {
		return view('livewire.event')
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}
