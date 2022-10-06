<?php

namespace App\Http\Livewire;

use App\Models\FormType;
use App\Services\EventFormService;
use App\Services\EventService;
use Livewire\Component;

class EventFormMaker extends Component {

    public $forms = [];
    public $formTypes;
    public $event;

    protected EventFormService $eventForm;
    protected EventService $eventService;

    public function boot(EventFormService $eventForm, EventService $eventService) {
        $this->eventForm = $eventForm;
        $this->eventService = $eventService;
    }

    public function mount(string $slug) {
        $this->event = $this->eventService->showBy('slug', $slug);
        $initInput = [
            'form_type_id' => 1,
            'judul' => '',
            'placeholder' => '',
            'value_options' => [
                [
                    'text' => '',
                    'value' => ''
                ]
            ]
        ];
        $this->forms[] = $initInput;
        $this->formTypes = FormType::all();
    }

    public function addInput() {
        $this->forms[] = [
            'form_type_id' => 1,
            'judul' => '',
            'placeholder' => '',
            'value_options' => [
                [
                    'text' => '',
                    'value' => ''
                ]
            ]
        ];
    }

    //TODO: implement nambah dan delete input option secara otomatis ketika form_type_id != 1

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

    public function createForm() {
        dd($this->forms);
        $created = $this->eventForm->createForm($this->forms);
        if ($created) {
            return redirect()->to('/event/'.$this->event->slug)
                ->with('status', 'Berhasil menambahkan form pada event '. $this->event->nama);
        }

        return redirect()->refresh()
            ->withErrors(['status' => 'Kesalahan terjadi saat membuat form']);
    }

    //TODO: implement edit form event

    public function render() {
        return view('livewire.event-form-maker')
            ->extends('layouts.app')
            ->section('content');
    }
}
