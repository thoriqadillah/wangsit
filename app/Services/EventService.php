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

class EventService
{

    public function showEvent()
    {
        return Event::where('tgl_tutup_pendaftaran', ">", Carbon::now())->get();
    }

    public function showBy(string $column, $value, bool $forAdmin = false)
    {
        if ($forAdmin) {
            return Event::where($column, $value)->get();
        }

        return Event::where($column, $value)
            ->where('tgl_tutup_pendaftaran', ">", Carbon::now())
            ->get();
    }

    public function showByDate(string $columnDate, string $sign, $optDate = null): Collection
    {
        $deptId = Auth::user()->admin->departement_id;
        if ($optDate === 'tgl_tutup_pendaftaran' || $optDate === 'tgl_tutup_pengumuman') {
            return Event::where('departement_id', $deptId)
                ->where($columnDate, $sign, Carbon::now())->where($optDate, $sign, Carbon::now())
                ->get();
        }
        return Event::where('departement_id', $deptId)
            ->where($columnDate, $sign, Carbon::now())
            ->get();
    }

    //Buat admin
    public function addEvent(array $eventData)
    {
        $hash = bin2hex(random_bytes(6));
        $eventCreate = Event::create([
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $eventData['nama'],
            'slug' => Str::slug($eventData['nama']) . '-' . $hash,
            'tgl_buka_pendaftaran' => $eventData['tgl_buka_pendaftaran'],
            'tgl_tutup_pendaftaran' => $eventData['tgl_tutup_pendaftaran'],
            'tgl_buka_pengumuman' => $eventData['tgl_buka_pengumuman'],
            'tgl_tutup_pengumuman' => $eventData['tgl_tutup_pengumuman'],
        ]);

        return $eventCreate;
    }

    public function updateEvent(array $eventData, int $id)
    {
        $hash = bin2hex(random_bytes(6));

        $eventUpdate = Event::where('id', $id)->update([
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $eventData['nama'],
            'slug' => Str::slug($eventData['nama']) . '-' . $hash,
            'tgl_buka_pendaftaran' => $eventData['tgl_buka_pendaftaran'],
            'tgl_tutup_pendaftaran' => $eventData['tgl_tutup_pendaftaran'],
            'tgl_buka_pengumuman' => $eventData['tgl_buka_pengumuman'],
            'tgl_tutup_pengumuman' => $eventData['tgl_tutup_pengumuman'],
        ]);

        return $eventUpdate;
    }

    public function deleteEvent(int $id): bool
    {
        $event = Event::find($id);
        return $event->delete();
    }
}
