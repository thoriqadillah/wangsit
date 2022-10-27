<?php

namespace App\Http\Livewire;

use App\Services\EventFormResponseService;
use App\Services\EventFormService;
use App\Services\UserService;
use Livewire\Component;

class EventRegistration extends Component {

	public $formResponse = [];
	public $eventForm;
	public $event;
	public $aggrement;

	public $userDept;

	protected EventFormService $eventFormService;
	protected EventFormResponseService $formResponseService;
	protected UserService $userService;
	
	public function boot(EventFormService $eventFormService, EventFormResponseService $formResponseService, UserService $userService) {
		$this->eventFormService = $eventFormService;
		$this->formResponseService = $formResponseService;
		$this->userService = $userService;
	}

	public function abortIfRoot() {
		$this->userDept = $this->userService->getUserDept();
		if (!$this->userDept) return abort(404);
	}

	public function mount(string $slug) {
		$this->abortIfRoot();
		
		$this->eventForm = $this->eventFormService->getEventForm($slug);
		if (!$this->eventForm) return abort(404);

		$this->event = $this->eventForm->event;
		$hasRegistered = $this->formResponseService->checkUserResponse($this->event->id);
		if ($hasRegistered) {
			$slug = $this->event->slug;
			return redirect()->to("/event/$slug/daftar/berhasil");
		}

		foreach ($this->eventForm->format as $index => $form) {
			$this->formResponse[$index] = [
				'judul' => $form['judul'],
				'required' => $form['required'],
				'response' => $form['form_type'] == 'Checkbox' ? [] : ''
			];
		}
	}

	public function saveResponse() {
		$validatorRules = $this->createRule($this->formResponse);
		$this->validate($validatorRules, ['required' => 'input wajib diisi']);
		
		$created = $this->formResponseService->saveResponse($this->event->id, $this->formResponse);
		if ($created) {
			$slug = $this->event->slug;
			return redirect()->to("/event/$slug/daftar/berhasil");
		}
	}

	public function createRule($formResponse) {
		$validatorRules = [];
		$validatorRules['aggrement'] = ['required'];

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
