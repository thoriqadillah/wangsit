<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventForm;

class EventFormService {

  public function createForm(array $format, int $eventId) {
    //memastikan opsinya dihapus semisal admin udah milih opsi selain text atau textare dan udah ngisi opsinya terus berubah pikiran tanpa menghapus opsinya
    for ($i=0; $i < count($format); $i++) { 
      if ($format[$i]['form_type'] === "Text" || $format[$i]['form_type'] === "Textarea") {
        $format[$i]['value_options'] = [
          ['text' => '', 'value' => '']
        ];
      //memastikan placeholdernya dihapus semisal admin udah milih opsi selain radio atau checkbox dan udah ngisi opsinya terus berubah pikiran tanpa menghapus opsinya
      } else {
        $format[$i]['placeholder'] = '';
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