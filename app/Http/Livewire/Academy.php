<?php

namespace App\Http\Livewire;

use App\Services\AcademyService;
use Livewire\Component;

class Academy extends Component {
	public $academies;
	public $search;

	protected AcademyService $academyService;

	public function boot(AcademyService $academyService) {
	    $this->academyService = $academyService;
	}

	public function mount() {
		$this->academies = $this->academyService->showAcademy();
	}

	public function updatedSearch() {
		$this->academies = $this->academyService->search($this->search);
	}

	public function render() {
		return view('livewire.academy')
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}
