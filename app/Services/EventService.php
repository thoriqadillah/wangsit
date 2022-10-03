<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Event;
use GuzzleHttp\Client;
use Illuminate\Foundation\Console\EventMakeCommand;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Facades\Auth;

class EventService {

    public function showEvent($perPage = 10) {
        return Event::where('end_date', ">", Carbon::now())->get();
    }

    public function showBy(string $column, $value, int $total = 10, bool $forAdmin = false): Collection {
        if ($forAdmin) {
            return Event::where($column, $value)->get();
        }

        return Event::where($column, $value)
            ->where('end_date', ">", Carbon::now())
            ->get();
    }

    //Buat admin
    public function addEvent(array $eventData): Collection {
        $hash = str_replace("=", "", base64_encode(Carbon::now()));

        return Event::create([
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $eventData['nama'],
            'slug' => Str::slug($eventData['nama']).'-'.$hash,
            'deskripsi' => $eventData['deskripsi'],
            'start_date' => $eventData['start_date'],
            'end_date' => $eventData['end_date'],
        ]);
    }

    public function updateEvent(array $eventData, int $id): Collection {
        $hash = str_replace("=", "", base64_encode(Carbon::now()));

        return Event::where('id', $id)->update([
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $eventData['nama'],
            'slug' => Str::slug($eventData['nama']).'-'.$hash,
            'deskripsi' => $eventData['deskripsi'],
            'start_date' => $eventData['start_date'],
            'end_date' => $eventData['end_date'],
        ]);
    }

    public function deleteEvent(int $id): bool {
        $event = Event::find($id);
        return $event->delete();
    }
}
