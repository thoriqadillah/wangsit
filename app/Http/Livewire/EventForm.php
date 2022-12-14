<?php

namespace App\Http\Livewire;

use App\Services\EventFormService;
use App\Services\EventService;
use App\Services\UserService;
use Livewire\Component;

class EventForm extends Component {

	public $forms = [];
	public $event;
	public $existedForm;
	public $isUpdate = false;

	public $userDept;

	protected EventFormService $eventFormService;
	protected EventService $eventService;
	protected UserService $userService;

	public function boot(EventFormService $eventFormService, EventService $eventService, UserService $userService) {
		$this->eventFormService = $eventFormService;
		$this->eventService = $eventService;
		$this->userService = $userService;
	}

	public function mount(string $slug) {
		$this->event = $this->eventService->showBy('slug', $slug);
		$this->userDept = $this->userService->getUserDept();
		if (!$this->userDept) return abort(404);
		if ($this->event->isEmpty()) return abort(404);
		
		$this->event = $this->event[0];
		$this->existedForm = $this->event->form;

		if ($this->existedForm) {
			$this->forms = $this->existedForm['format'];
			$this->isUpdate = true;
		} else {
			$this->forms[] = [
				'form_type' => "Text",
				'judul' => '',
				'placeholder' => '',
				'required' => false,
				'options' => ['']
			];
		}
	}

	public function addInput(int $position) {
		$newInput = [
			[
				'form_type' => "Text",
				'judul' => '',
				'placeholder' => '',
				'required' => false,
				'options' => ['']
			]
		];
		array_splice($this->forms, $position, 0, $newInput);
	}

	public function addInputOption(int $index) {
		$this->forms[$index]['options'][] = '';
	}

	public function deleteInputOption(int $inputId, int $optionId) {
		if (count($this->forms[$inputId]['options']) > 1) {
			unset($this->forms[$inputId]['options'][$optionId]);
			$this->forms[$inputId]['options'] = array_values($this->forms[$inputId]['options']);
		}
	}

	public function deleteInput(int $index) {
		if (count($this->forms) > 1) {
			unset($this->forms[$index]);
			$this->forms = array_values($this->forms);
		}
	}

	public function createForm() {
		$validatorRules = $this->createRule($this->forms);
		$this->validate($validatorRules, ['required' => 'input wajib diisi']);

		$created = $this->eventFormService->createForm($this->forms, $this->event->id);
		if ($created) {
			return redirect()->to('/admin/event/'.$this->event->slug . '/form')
				->with('success', 'Berhasil menambahkan form pada event '. $this->event->nama);
		}
	}

	public function updateForm() {
		$validatorRules = $this->createRule($this->forms);
		$this->validate($validatorRules, ['required' => 'input wajib diisi']);

		$updated = $this->eventFormService->updateForm($this->forms, $this->event->id);
		if ($updated) {
			return redirect()->to('/admin/event/'.$this->event->slug . '/form')
				->with('success', 'Form berhasil diupdate');
		}
	}

	public function createRule($forms) {
		$validatorRules = [];
		foreach ($forms as $i => $form) {
			$validatorRules["forms.$i.judul"] = ['required'];
			
			if ($form['form_type'] == "Text" || $form['form_type'] == "Textarea") {
				$validatorRules["forms.$i.placeholder"] = ['required'];
			} else {
				foreach ($form['options'] as $j => $opt) {
					$validatorRules["forms.$i.options.$j"] = ['required'];
				}
			}
		}
		
		return $validatorRules;
	}

	public function render() {
		return view('livewire.admin.event-form')
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}
