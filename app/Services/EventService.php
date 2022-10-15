<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EventService {

    public function getLatestEvent() {
        return Event::where('tgl_buka_pendaftaran', '<=', Carbon::now())
            ->where('tgl_tutup_pendaftaran', '>=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
    }

    public function showEvent() {
        return Event::where('tgl_tutup_pendaftaran', ">", Carbon::now())->get();
    }

    public function showBy(string $column, $value, bool $forAdmin = false): Collection {
        if ($forAdmin) {
            return Event::where($column, $value)->get();
        }

        return Event::where($column, $value)
            ->where('tgl_tutup_pendaftaran', ">", Carbon::now())
            ->get();
    }

    //Buat admin
    public function addEvent(array $eventData): Collection {
        $hash = str_replace("=", "", base64_encode(Carbon::now()));

        return Event::create([
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $eventData['nama'],
            'slug' => Str::slug($eventData['nama']).'-'.$hash,
            'tgl_buka_pendaftaran' => $eventData['tgl_buka_pendaftaran'],
            'tgl_tutup_pendaftaran' => $eventData['tgl_tutup_pendaftaran'],
            'tgl_buka_pengumuman' => $eventData['tgl_buka_pengumuman'],
            'tgl_tutup_pengumuman' => $eventData['tgl_tutup_pengumuman'],
        ]);
    }

    public function updateEvent(array $eventData, int $id): Collection {
        $hash = str_replace("=", "", base64_encode(Carbon::now()));

        return Event::where('id', $id)->update([
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $eventData['nama'],
            'slug' => Str::slug($eventData['nama']).'-'.$hash,
            'tgl_buka_pendaftaran' => $eventData['tgl_buka_pendaftaran'],
            'tgl_tutup_pendaftaran' => $eventData['tgl_tutup_pendaftaran'],
            'tgl_buka_pengumuman' => $eventData['tgl_buka_pengumuman'],
            'tgl_tutup_pengumuman' => $eventData['tgl_tutup_pengumuman'],
        ]);
    }

    public function deleteEvent(int $id): bool {
        $event = Event::find($id);
        return $event->delete();
    }
}
