<?php

namespace App\Http\Livewire;

use App\Models\EventForm;
use App\Models\FormType;
use App\Services\EventFormService;
use App\Services\EventService;
use Livewire\Component;

class EventFormMaker extends Component {

	public $forms = [];
	public $formTypes;
	public $event;
	public $existedForm;
	public $isUpdate = false;

	protected EventFormService $eventFormService;
	protected EventService $eventService;

	public function boot(EventFormService $eventFormService, EventService $eventService) {
		$this->eventFormService = $eventFormService;
		$this->eventService = $eventService;
	}

	public function mount(string $slug) {
		$this->formTypes = FormType::all();
		$this->event = $this->eventService->showBy('slug', $slug);
		if ($this->event->isEmpty()) return abort(404);
		
		$this->existedForm = $this->event[0]->form;

		if ($this->existedForm) {
			$this->forms = $this->existedForm['format'];
			$this->isUpdate = true;
		} else {
			$this->forms[] = [
				'form_type_id' => "Text",
				'judul' => '',
				'placeholder' => '',
				'required' => false,
				'value_options' => [
					[
						'text' => '',
						'value' => ''
					]
				]
			];
		}
	}

	public function addInput(int $position) {
		$newInput = [
			[
				'form_type_id' => "Text",
				'judul' => '',
				'placeholder' => '',
				'required' => false,
				'value_options' => [
					[
						'text' => '',
						'value' => ''
					]
				]
			]
		];
		array_splice($this->forms, $position, 0, $newInput);
	}

	public function addInputOption(int $index) {
		$this->forms[$index]['value_options'][] = [
			'text' => '',
			'value' => ''
		];
	}

	public function deleteInputOption(int $inputId, int $optionId) {
		if (count($this->forms[$inputId]['value_options']) > 1) {
			unset($this->forms[$inputId]['value_options'][$optionId]);
			$this->forms[$inputId]['value_options'] = array_values($this->forms[$inputId]['value_options']);
		}
	}

	public function deleteInput(int $index) {
		if (count($this->forms) > 1) {
			unset($this->forms[$index]);
			$this->forms = array_values($this->forms);
		}
	}

	public function setRequired(int $index) {
		$this->forms[$index]['required'] = !$this->forms[$index]['required'];
	}

	public function createForm() {
		$validatorRules = $this->createRule($this->forms);
		$this->validate($validatorRules, ['required' => 'input wajib diisi']);

		$created = $this->eventFormService->createForm($this->forms, $this->event[0]->id);
		if ($created) {
			return redirect()->to('/event/'.$this->event[0]->slug)
				->with('status', 'Berhasil menambahkan form pada event '. $this->event[0]->nama);
		}

		return redirect()->refresh()
			->withErrors(['status' => 'Kesalahan terjadi saat membuat form']);
	}

	public function updateForm() {
		$validatorRules = $this->createRule($this->forms);
		$this->validate($validatorRules, ['required' => 'input wajib diisi']);

		$updated = $this->eventFormService->updateForm($this->forms, $this->event[0]->id);
		if ($updated) {
			return redirect()->to('/event/'.$this->event[0]->slug)
				->with('status', 'Berhasil menambahkan form pada event '. $this->event[0]->nama);
		}

		return redirect()->refresh()
			->withErrors(['status' => 'Kesalahan terjadi saat membuat form']);
	}

	public function createRule($forms) {
		$validatorRules = [];
		foreach ($forms as $i => $form) {
			$validatorRules["forms.$i.judul"] = ['required'];
			$validatorRules["forms.$i.placeholder"] = ['required'];
			
			if ($form['form_type_id'] !== "Text" && $form['form_type_id'] !== "Textarea") {
				foreach ($form['value_options'] as $j => $opt) {
					$validatorRules["forms.$i.value_options.$j.text"] = ['required'];
					$validatorRules["forms.$i.value_options.$j.value"] = ['required'];
				}
			}
		}
		
		return $validatorRules;
	}

	public function render() {
		return view('livewire.event-form-maker')
			->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');
	}
}