<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventForm;

class EventFormService {

  public function createForm(array $format, int $eventId) {
    //memastikan opsinya dihapus semisal admin udah milih opsi selain text dan udah ngisi opsinya terus berubah pikiran tanpa menghapus opsinya
    for ($i=0; $i < count($format); $i++) { 
      if ($format[$i]['form_type_id'] === "Text" || $format[$i]['form_type_id'] === "Textarea") {
        $format[$i]['value_options'] = [
          ['text' => '', 'value' => '']
        ];
      }
    }

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
    $event = Event::where('slug', $slug)->first();
    return $event == null ? null : $event->form;
  }
}