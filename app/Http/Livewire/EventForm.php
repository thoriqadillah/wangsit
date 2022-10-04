<?php

namespace App\Http\Livewire;

use App\Services\EventFormService;
use App\Services\EventService;
use Livewire\Component;

class EventForm extends Component {

    public $forms = [];

    protected EventFormService $eventForm;
    protected EventService $event;

    public function boot(EventFormService $eventForm, EventService $event) {
        $this->eventForm = $eventForm;
        $this->event = $event;
    }

    public function mount() {
        $this->forms = [
            'form_type_id' => 1,
            'nama' => '',
            'judul' => '',
            'placeholder' => '',
            'value_options' => []
        ];
    }

    public function addInput() {
        $this->forms[] = [
            'form_type_id' => 1,
            'nama' => '',
            'judul' => '',
            'placeholder' => '',
            'value_options' => null
        ];
    }

    //TODO: implement nambah dan delete input option secara otomatis ketika form_type_id != 1

    public function addInputOption(int $index) {
        $forms[$index]['value_option'][] = [
            'text' => '',
            'value' => ''
        ];
    }

    public function deleteInputOption(int $input_id, int $option_id) {
        unset($this->forms[$input_id]['value_options'][$option_id]);
        $this->forms[$input_id]['value_options'] = array_values($this->forms[$input_id]['value_options']);
    }

    public function deleteInput(int $index) {
        unset($this->forms[$index]);
        $this->forms = array_values($this->forms);
    }

    public function createForm(int $event_id) {
        $event = $this->event->showBy('id', $event_id);
        $created = $this->eventForm->createForm($this->forms);
        if ($created) {
            return redirect()->to('/event/'.$event->slug)
                ->with('status', 'Berhasil menambahkan form pada event '. $event->nama);
        }

        return redirect()->refresh()
            ->withErrors(['status' => 'Gagal menambahkan form']);
    }

    public function render() {
        return view('livewire.event-form')
            ->extends('layouts.app')
            ->section('content');
    }
}
