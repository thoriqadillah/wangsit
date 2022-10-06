<?php

namespace App\Services;

use App\Models\EventFormResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EventFormResponseService {

  /**
   * Untuk mencegah user mendaftarkan diri pada event 2x
   */
  public function findOrSaveResponse(int $event_id, array $responseData): Collection {
    return EventFormResponse::firstOrCreate(['event_id' => $event_id, 'user_id' => Auth::id()], [
      'response' => json_encode($responseData)
    ]);
  }

  public function getResponses(int $event_id, int $perPage = 15) {
    return EventFormResponse::where('event_id', $event_id)->paginate($perPage);
  }
}