<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Models\Event as ModelsEvent;
use App\Services\EventService;
use Livewire\Component;

class Event extends Component {
    
    public $departements;
    public $events;

    protected EventService $eventService;

    public function boot(EventService $eventService) {
        $this->eventService = $eventService;
    }
    
    public function mount() {
        $this->departements = Departement::all();
        $this->events = $this->eventService->showEvent();
    }
    
    public function showEvents(int $dept_id = 0) {
        if ($dept_id == 0) {
            $this->events = $this->eventService->showEvent();
        } else {
            $this->events = $this->eventService->showBy('departement_id', $dept_id);
        }
    }

    public function render() {
        return view('livewire.event')
            ->extends('layouts.app')
            ->section('content');
    }
}
