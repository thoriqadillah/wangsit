<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Services\EventService;
use Livewire\Component;
use Livewire\WithPagination;

class Event extends Component {

	use WithPagination;

	private $perPage = 20;
	
	public $filter = 'aktif';
	public $departements;
	public $deptId = 0;

	protected EventService $eventService;

	public function boot(EventService $eventService) {
		$this->eventService = $eventService;
	}

	public function mount() {
		$this->departements = Departement::all();
	}

	public function setDept(int $deptId = 0) {
		$this->deptId = $deptId;
	}

	public function render() {
		$data = [
			'events' => $this->eventService->showByFilter($this->filter, $this->deptId, $this->filter == 'aktif' ? 'form' : 'graduees', $this->perPage)
		];
		return view('livewire.event', $data)
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}
