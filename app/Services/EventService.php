<?php

namespace App\Services;

use App\Http\Livewire\EventForm;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventFormResponse;
use Illuminate\Support\Str;
use App\Models\EventLulusStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

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

    public function detailEvent($slug)
    {
        return Event::where('slug', $slug)->first();
    }

    public function showBy(string $column, $value, $eagerWith = 'form', $perPage = 10)
    {
        return Event::with($eagerWith)
            ->where($column, $value)
            ->paginate($perPage);
    }

    public function showByFilter($filter, $deptId = 0, string $eargerWith = 'form', $perPage = 10, $forAdmin = true)
    {
        if ($forAdmin && $filter == 'pengumuman') return $this->showPengumuman($deptId, $eargerWith, $perPage);
        if (!$forAdmin && $filter == 'pengumuman') return $this->showPengumumanUser($deptId, $eargerWith, $perPage);
        if ($filter == 'pendaftaran') return $this->showAktif($deptId, $eargerWith, $perPage);
        if ($filter == 'waiting') return $this->showWaiting($deptId, $eargerWith, $perPage);
        if ($filter == 'tutup') return $this->showTutup($deptId, $eargerWith, $perPage);

        return $this->showBy('departement_id', $deptId, $eargerWith, $perPage);
    }

    public function showAktif(int $deptId, string $eagerWith = 'form', $perPage = 10)
    {
        if ($deptId != 0) {
            return Event::with($eagerWith)
                ->where('departement_id', $deptId)
                ->where('tgl_buka_pendaftaran', '<=', Carbon::now())
                ->where('tgl_tutup_pendaftaran', '>=', Carbon::now())
                ->paginate($perPage);
        }
        return Event::with($eagerWith)
            ->where('tgl_buka_pendaftaran', '<=', Carbon::now())
            ->where('tgl_tutup_pendaftaran', '>=', Carbon::now())
            ->paginate($perPage);
    }

    public function showPengumumanUser(int $deptId, string $eagerWith = 'form', $perPage = 10)
    {
        if ($deptId !== 0) {
            return Event::join('event_lulus_statuses', 'event_lulus_statuses.event_id', '=', 'events.id')
                ->where('departement_id', $deptId)
                ->where('tgl_buka_pengumuman', '<=', Carbon::now())
                ->where('tgl_tutup_pengumuman', '>=', Carbon::now())
                ->where('user_id', Auth::id())
                ->paginate($perPage);
        }

        return Event::join('event_lulus_statuses', 'event_lulus_statuses.event_id', '=', 'events.id')
            ->where('tgl_buka_pengumuman', '<=', Carbon::now())
            ->where('tgl_tutup_pengumuman', '>=', Carbon::now())
            ->where('user_id', Auth::id())
            ->paginate($perPage);
    }

    public function showPengumuman(int $deptId, string $eagerWith = 'form', $perPage = 10)
    {
        if ($deptId !== 0) {
            return Event::with($eagerWith)
                ->where('departement_id', $deptId)
                ->where('tgl_buka_pengumuman', '<=', Carbon::now())
                ->where('tgl_tutup_pengumuman', '>=', Carbon::now())
                ->paginate($perPage);
        }

        return Event::with($eagerWith)
            ->where('tgl_buka_pengumuman', '<=', Carbon::now())
            ->where('tgl_tutup_pengumuman', '>=', Carbon::now())
            ->paginate($perPage);
    }

    public function showWaiting(int $deptId, string $eagerWith = 'form', $perPage = 10)
    {
        if ($deptId !== 0) {
            return Event::with($eagerWith)
                ->where('departement_id', $deptId)
                ->where('tgl_buka_pendaftaran', '>', Carbon::now())
                ->paginate($perPage);
        }

        return Event::with($eagerWith)
            ->where('tgl_buka_pendaftaran', '<', Carbon::now())
            ->paginate($perPage);
    }

    public function showTutup(int $deptId, string $eagerWith = 'form', $perPage = 10)
    {
        if ($deptId !== 0) {
            return Event::with($eagerWith)
                ->where('departement_id', $deptId)
                ->where('tgl_tutup_pengumuman', '<', Carbon::now())
                ->paginate($perPage);
        }

        return Event::with($eagerWith)
            ->where('tgl_tutup_pengumuman', '<', Carbon::now())
            ->paginate($perPage);
    }

    public function addEvent(array $eventData)
    {
        $year = Carbon::now()->format('Y');

        $path = $eventData['thumbnail']->store("/public/$year");
        $eventData['thumbnail'] = $path;

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
        $year = Carbon::now()->format('Y');

        if ($eventData['thumbnail'] ===  $eventData['thumbnailLama']) {
            $eventData['thumbnail'] = $eventData['thumbnailLama'];
        } else {
            $path = $eventData['thumbnail']->store("/public/$year");
            Storage::delete($eventData['thumbnailLama']);
            $eventData['thumbnail'] = $path;
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
        Storage::delete($event->thumbnail);
        EventForm::where('event_id', $event->id)->delete();
        EventFormResponse::where('event_id', $event->id)->delete();
        EventLulusStatus::where('event_id', $event->id)->delete();
        return $event->delete();
    }

    public function lulusEvent(array $lulusData, $eventId)
    {
        $participant = EventLulusStatus::where('event_id', $eventId)->get();
        $userId = $lulusData['userId'];
        $lulus = $lulusData['lulus'];


        EventLulusStatus::where('event_id', $eventId)->update([
            'status_lulus' => 0
        ]);

        if (isset($lulus)) {
            for ($i = 0; $i < count($lulus); $i++) {
                $update = EventLulusStatus::where('event_id', $eventId)->where('user_id', $lulus[$i])->update([
                    'status_lulus' => 1
                ]);
            }
        } else {
            $update = EventLulusStatus::where('event_id', $eventId)->update([
                'status_lulus' => 0
            ]);
        }


        return $update;
    }
}
