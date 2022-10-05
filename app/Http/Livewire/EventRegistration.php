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

        foreach ($this->eventForm as $index => $form) {
            $this->formResponse[$index] = [
                'judul' => $form->judul
            ];
        }
    }

    public function saveResponse() {
        $event = $this->eventForm[0]->event;

        $created = $this->formResponseService->saveResponse($event->id, $this->formResponse);
        if ($created) {
            return redirect()->to("/event/$event->slug")
                ->with('status', "Berhasil mendaftar event $event->nama");
        }

        return redirect()->refresh()
            ->withErrors(['status' => "Berhasil mendaftar event $event->nama"]);
    }

    public function render() {
        return view('livewire.event-registration')
            ->extends('layouts.app')
            ->section('content');
    }
}
