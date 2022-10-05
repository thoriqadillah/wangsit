<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventForm;
use Illuminate\Database\Eloquent\Collection;

class EventFormService {

  public function createForm(array $forms) {
    //encoding assoc array to json
    foreach ($forms as $form) {
      $form['value_options'] = $form['value_options'] == null 
        ? null
        : json_encode($form['value_options']);
    }

    return EventForm::insert($forms);
  }

  public function getEventForm(string $slug): Collection {
    return Event::where('slug', $slug)->first()->forms;
  }
}