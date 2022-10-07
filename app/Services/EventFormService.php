<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventForm;

class EventFormService {

  public function createForm(array $format, int $eventId) {
    return EventForm::create([
      'event_id' => $eventId,
      'format' => $format
    ]);
  }

  public function updateForm(array $format, int $eventId) {
    return EventForm::where('event_id', $eventId)->update([
      'format' => $format
    ]);
  }

  public function getEventForm(string $slug) {
    return Event::where('slug', $slug)->first()->forms;
  }
}