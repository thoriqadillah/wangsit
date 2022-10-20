<?php

namespace App\Services;

use App\Models\EventLulusStatus;
use Illuminate\Support\Facades\Auth;

class AnnouncementService {

  public function checkUser(int $eventId) {
    return EventLulusStatus::where('event_id', $eventId)
      ->where('user_id', Auth::id())
      ->first();
  }
}