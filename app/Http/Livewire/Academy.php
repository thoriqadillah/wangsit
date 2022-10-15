<?php

namespace App\Http\Livewire;

use App\Models\Academy as ModelsAcademy;
use Livewire\Component;

class Academy extends Component {
	public $academies;
	public $search;

	// protected AcademyService $academyService;

	// public function boot(AcademyService $academyService) {
	//     $this->academyService = $academyService;
	// }

	//TODO: gunakan academyService
	public function mount() {
		$this->academies = ModelsAcademy::all();
	}

	//TODO: gunakan academyService
	public function updatedSearch() {
		$this->academies = ModelsAcademy::where('nama', 'like', "%$this->search%")->get();
	}

	public function render() {
		return view('livewire.academy')
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}
