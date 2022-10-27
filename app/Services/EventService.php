<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventService
{

    public function getLatestEvent()
    {
        $events = Event::where('tgl_buka_pendaftaran', '<=', Carbon::now())
            ->where('tgl_tutup_pendaftaran', '>=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $now = Carbon::now();
        foreach ($events as $i => $event) {
            $events[$i]->countdown = $now->diffInDays($event->tgl_tutup_pendaftaran);
        }

        return $events;
    }

    public function showEvent()
    {
        return Event::where('tgl_tutup_pendaftaran', ">", Carbon::now())->get();
    }

    public function detailEvent($slug)
    {
        return Event::where('slug', $slug)->first();
    }

    public function showBy(string $column, $value)
    {
        return Event::where($column, $value)->get();
    }

    public function showAktif(int $deptId)
    {
        if ($deptId != 0) {
            return Event::with('form')
                ->where('departement_id', $deptId)
                ->where('tgl_buka_pendaftaran', '<=', Carbon::now())
                ->where('tgl_tutup_pendaftaran', '>=', Carbon::now())
                ->get();
        }
        return Event::with('form')
            ->where('tgl_buka_pendaftaran', '<=', Carbon::now())
            ->where('tgl_tutup_pendaftaran', '>=', Carbon::now())
            ->get();
    }

    public function showPengumuman(int $deptId)
    {
        if ($deptId !== 0) {
            return Event::with('form')
                ->where('departement_id', $deptId)
                ->where('tgl_buka_pengumuman', '<=', Carbon::now())
                ->where('tgl_tutup_pengumuman', '>=', Carbon::now())
                ->get();
        }

        return Event::with('form')
            ->where('tgl_buka_pengumuman', '<=', Carbon::now())
            ->where('tgl_tutup_pengumuman', '>=', Carbon::now())
            ->get();
    }

    public function showWaiting(int $deptId)
    {
        if ($deptId !== 0) {
            return Event::with('form')
                ->where('departement_id', $deptId)
                ->where('tgl_buka_pendaftaran', '>', Carbon::now())
                ->get();
        }

        return Event::with('form')
            ->where('tgl_buka_pendaftaran', '<', Carbon::now())
            ->get();
    }

    public function showTutup(int $deptId)
    {
        if ($deptId !== 0) {
            return Event::with('form')
                ->where('departement_id', $deptId)
                ->where('tgl_tutup_pengumuman', '<', Carbon::now())
                ->get();
        }

        return Event::with('form')
            ->where('tgl_tutup_pengumuman', '<', Carbon::now())
            ->get();
    }

    public function addEvent(array $eventData)
    {
        $year = Carbon::now()->format('Y');

        $path = $eventData['thumbnail']->store("/public/$year");
        $eventData['thumbnail'] = $path;

        if ($eventData['adanya_kelulusan'] == true) {
            $eventData['adanya_kelulusan'] = 1;
        } else {
            $eventData['adanya_kelulusan'] = 0;
        }
        $hash = bin2hex(random_bytes(6));
        return Event::create([
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $eventData['nama'],
            'slug' => Str::slug($eventData['nama']) . '-' . $hash,
            'thumbnail' => $path,
            'adanya_kelulusan' => $eventData['adanya_kelulusan'],
            'tgl_buka_pendaftaran' => $eventData['tgl_buka_pendaftaran'],
            'tgl_tutup_pendaftaran' => $eventData['tgl_tutup_pendaftaran'],
            'tgl_buka_pengumuman' => $eventData['tgl_buka_pengumuman'],
            'tgl_tutup_pengumuman' => $eventData['tgl_tutup_pengumuman'],
        ]);
    }

    public function updateEvent(array $eventData, int $id)
    {
        // dd($eventData['thumbnail']);
        $year = Carbon::now()->format('Y');

        if ($eventData['thumbnail'] ===  $eventData['thumbnailLama']) {
            $eventData['thumbnail'] = $eventData['thumbnailLama'];
            dd($eventData['thumbnail']);
        } else {
            $path = $eventData['thumbnail']->store("/public/$year");
            $eventData['thumbnail'] = $path;
            // dd($eventData['thumbnail']);
        }

        if ($eventData['adanya_kelulusan'] == true) {
            $eventData['adanya_kelulusan'] = 1;
        } else {
            $eventData['adanya_kelulusan'] = 0;
        }

        $hash = bin2hex(random_bytes(6));

        return Event::where('id', $id)->update([
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $eventData['nama'],
            'slug' => Str::slug($eventData['nama']) . '-' . $hash,
            'thumbnail' => $eventData['thumbnail'],
            'adanya_kelulusan' => $eventData['adanya_kelulusan'],
            'tgl_buka_pendaftaran' => $eventData['tgl_buka_pendaftaran'],
            'tgl_tutup_pendaftaran' => $eventData['tgl_tutup_pendaftaran'],
            'tgl_buka_pengumuman' => $eventData['tgl_buka_pengumuman'],
            'tgl_tutup_pengumuman' => $eventData['tgl_tutup_pengumuman'],
        ]);
    }

    public function deleteEvent(int $id): bool
    {
        $event = Event::find($id);
        return $event->delete();
    }
}
