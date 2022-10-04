<?php

namespace App\Services;

use App\Models\EventForm;

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
}