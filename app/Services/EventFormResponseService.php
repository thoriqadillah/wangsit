<?php

namespace App\Services;

use App\Models\EventFormResponse;
use Illuminate\Support\Facades\Auth;

class EventFormResponseService {

  public function saveResponse(int $event_id, array $responseData) {
    return EventFormResponse::create([
      'event_id' => $event_id,
      'user_id' => Auth::id(),
      'response' => json_encode($responseData)
    ]);
  }
}