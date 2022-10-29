<?php

namespace App\Http\Livewire;

use App\Services\DepartementService;
use App\Services\EventService;
use Livewire\Component;
use Livewire\WithPagination;

class Event extends Component {

	use WithPagination;

	private $perPage = 20;
	
	public $filter = 'pendaftaran';
	public $departements;
	public $deptId = 0;

	protected EventService $eventService;
	protected DepartementService $departementService;

	public function boot(EventService $eventService, DepartementService $departementService) {
		$this->eventService = $eventService;
		$this->departementService = $departementService;
	}

	public function mount() {
		$this->departements = $this->departementService->getAll();
	}

	public function setDept(int $deptId = 0) {
		$this->deptId = $deptId;
	}

	public function render() {
		$data = [
			'events' => $this->eventService->showByFilter($this->filter, $this->deptId, $this->filter == 'pendaftaran' ? 'form' : 'graduees', $this->perPage, false)
		];
		return view('livewire.event', $data)
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}
