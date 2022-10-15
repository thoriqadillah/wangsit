<?php

namespace App\Http\Livewire;

use App\Services\EventFormResponseService;
use App\Services\EventFormService;
use Livewire\Component;

class EventRegistration extends Component {

	public $formResponse = [];
	public $eventForm;

	protected EventFormService $eventFormService;
	protected EventFormResponseService $formResponseService;

	public function boot(EventFormService $eventFormService, EventFormResponseService $formResponseService) {
		$this->eventFormService = $eventFormService;
		$this->formResponseService = $formResponseService;
	}

	public function mount(string $slug) {
		$this->eventForm = $this->eventFormService->getEventForm($slug);
		if (!$this->eventForm) return abort(404);

		$event = $this->eventForm->event;
		$hasRegistered = $this->formResponseService->checkUserResponse($this->eventForm->event->id);
		if ($hasRegistered) {
			return redirect()->to("/event/$event->slug/berhasil");
		}

		foreach ($this->eventForm->format as $index => $form) {
			$this->formResponse[$index] = [
				'judul' => $form['judul'],
				'required' => $form['required']
			];
		}
	}

	public function saveResponse() {
		$event = $this->eventForm->event;
		$validatorRules = $this->createRule($this->formResponse);
		$this->validate($validatorRules, ['required' => 'input wajib diisi']);

		$created = $this->formResponseService->saveResponse($event->id, $this->formResponse);
		if ($created) {
			return redirect()->to("/event/$event->slug/berhasil");
		}
	}

	public function createRule($formResponse) {
		$validatorRules = [];
		foreach ($formResponse as $i => $form) {
			if ($form['required']) {
				$validatorRules["formResponse.$i.response"] = ['required'];
			}
		}

		return $validatorRules;
	}

	public function render() {
		return view('livewire.event-registration')
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}
