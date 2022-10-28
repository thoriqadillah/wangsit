<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\EventLulusStatus;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Services\UserService;
use Illuminate\Validation\Rules\File;
use Symfony\Contracts\Service\Attribute\Required;

class EventController extends Controller
{
    public $userDept;

    protected EventService $event;
    protected UserService $userService;

    public function __construct(EventService $eventService, UserService $userService)
    {
        $this->event = $eventService;
        $this->userService = $userService;
    }

    public function abortIfRoot()
    {
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);
    }

    public function detailEvent($slug)
    {
        $detail = $this->event->detailEvent($slug);
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);
        if (!$detail) return abort(404);

        $department = Departement::all();

        $data = [
            'detail' => $detail,
            'departement' => $department
        ];

        return view('admin/form-event', $data);
    }


    public function addEvent(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'thumbnail' =>  'mimes:jpeg,png,jpg|image|max:2000',
            'tgl_buka_pendaftaran' => 'required',
            'tgl_tutup_pendaftaran' => 'required',
            'tgl_buka_pengumuman' => 'required',
            'tgl_tutup_pengumuman' => 'required',
            'adanya_kelulusan' => 'required'
        ], [
            'required' => ':attribute wajib diisi',
            'tgl_buka_pendaftaran.required' => 'waktu mulai wajib diisi',
            'tgl_tutup_pendaftaran.required' => 'waktu selesai wajib diisi',
            'tgl_buka_pengumuman.required' => 'waktu mulai wajib diisi',
            'tgl_tutup_pengumuman.required' => 'waktu selesai wajib diisi'
        ]);

        $event = $this->event->addEvent($validated);
        if ($event) {
            return redirect('/admin/event')->with('success', 'Event berhasil ditambah');
        }
        return redirect()->refresh()->withInput()->withErrors(['error' => 'Event gagal ditambah']);
    }

    public function updateEvent(Request $request, int $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'thumbnailLama' => 'required',
            'thumbnail' => 'mimes:jpeg,png,jpg|image|max:2000',
            'adanya_kelulusan' => 'required',
            'tgl_buka_pendaftaran' => 'required',
            'tgl_tutup_pendaftaran' => 'required',
            'tgl_buka_pengumuman' => 'required',
            'tgl_tutup_pengumuman' => 'required',
        ], [
            'required' => ':attribute wajib diisi',
            'tgl_buka_pendaftaran.required' => 'waktu mulai wajib diisi',
            'tgl_tutup_pendaftaran.required' => 'waktu selesai wajib diisi',
            'tgl_buka_pengumuman.required' => 'waktu mulai wajib diisi',
            'tgl_tutup_pengumuman.required' => 'waktu selesai wajib diisi'
        ]);

        if (is_null($request->thumbnail)) {
            $validated['thumbnail'] = $request->thumbnailLama;
        }

        $updEvent = $this->event->updateEvent($validated, $id);
        if ($updEvent) {
            return redirect()->to('/admin/event')->with('success', 'Event berhasil diupdate');
        }

        return redirect()->refresh()->withErrors(['error' => 'Event gagal diupdate']);
    }

    public function addEventPage()
    {
        $department = Departement::all();
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);

        $data = [
            'departement' => $department
        ];
        return view('/admin/form-event', $data);
    }

    public function responseEvent($slug)
    {
        return view('/admin/form-response');
    }

    public function lulusEvent(Request $request, $eventId)
    {
        $userId = $request->userId;
        $lulus = $request->lulus;
        for ($i = 0; $i < count($lulus); $i++) {
            $update = EventLulusStatus::where('event_id', $eventId)->where('user_id', $userId[$i])->update([
                'status_lulus' => $lulus[$i]
            ]);
        }

        if ($update) {
            // return redirect()->to('/admin/event')->with('success', 'Data peserta lulus berhasil diupdate');
            dd($lulus);
        }
        return redirect()->refresh()->withErrors(['error' => 'Data peserta diupdate']);
    }
}
