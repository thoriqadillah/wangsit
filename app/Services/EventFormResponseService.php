<?php

namespace App\Services;

use App\Models\EventFormResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EventFormResponseService {

  /**
   * Untuk mencegah user mendaftarkan diri pada event 2x
   */
  public function saveResponse(array $responseData) {
    return EventFormResponse::create([
      'response' => $responseData
    ]);
  }

  public function getResponses(int $eventId, int $perPage = 15) {
    return EventFormResponse::where('event_id', $eventId)->paginate($perPage);
  }

  public function checkUserResponse(int $eventId) {
    return EventFormResponse::where('event_id', $eventId)
      ->where('user_id', Auth::id())
      ->first();
  }
}