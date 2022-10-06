<?php

namespace App\Services;

use App\Models\EventFormResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EventFormResponseService {

  /**
   * Untuk mencegah user mendaftarkan diri pada event 2x
   */
  public function findOrSaveResponse(int $eventId, array $responseData): Collection {
    return EventFormResponse::firstOrCreate(['event_id' => $eventId, 'user_id' => Auth::id()], [
      'response' => json_encode($responseData)
    ]);
  }

  public function getResponses(int $eventId, int $perPage = 15) {
    return EventFormResponse::where('event_id', $eventId)->paginate($perPage);
  }
}