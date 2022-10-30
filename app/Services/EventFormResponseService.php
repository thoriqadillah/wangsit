<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventForm;
use App\Models\EventFormResponse;
use App\Models\EventLulusStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EventFormResponseService
{

  public function saveResponse(int $eventId, array $responseData)
  {
    //jika ada kelulusan pada suatu event, buat data default tidak diterima pada setiap pendaftar
    $event = Event::find($eventId);
    if ($event->adanya_kelulusan) {
      EventLulusStatus::firstOrCreate(['event_id' => $eventId, 'user_id' => Auth::id()], [
        'status_lulus' => false
      ]);
    }

    // Untuk mencegah user mendaftarkan diri pada event 2x
    return EventFormResponse::firstOrCreate(['event_id' => $eventId, 'user_id' => Auth::id()], [
      'response' => $responseData
    ]);
  }

  public function getResponses(int $eventId, int $perPage = 15)
  {
    return EventFormResponse::with('user')->where('event_id', $eventId)->get();
  }

  public function checkUserResponse(int $eventId)
  {
    return EventFormResponse::where('event_id', $eventId)
      ->where('user_id', Auth::id())
      ->first();
  }

  public function getHeadResponse(string $slug)
  {
    $event = Event::where('slug', $slug)->first();

    return EventForm::where('event_id', $event->id)->first();
  }

  public function getLulusResponse(string $slug)
  {
    $event = Event::where('slug', $slug)->first();
    return EventLulusStatus::where('event_id', $event->id)->where('status_lulus', 1)->get();
  }

  public function getEventSlug(string $slug)
  {
    $event = Event::where('slug', $slug)->first();
    return $event;
  }
}
