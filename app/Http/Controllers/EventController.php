<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\EventService;
use App\Models\EventLulusStatus;
use App\Services\DepartementService;
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

        $data = [
            'detail' => $detail,
        ];

        return view('admin/form-event', $data);
    }


    public function addEvent(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'thumbnail' =>  'mimes:jpeg,png,jpg|image|max:2000|required',
            'tgl_buka_pendaftaran' => 'required',
            'tgl_tutup_pendaftaran' => 'required',
            'tgl_buka_pengumuman' => 'required',
            'tgl_tutup_pengumuman' => 'required'
        ], [
            'required' => ':attribute wajib diisi',
            'tgl_buka_pendaftaran.required' => 'waktu mulai wajib diisi',
            'tgl_tutup_pendaftaran.required' => 'waktu selesai wajib diisi',
            'tgl_buka_pengumuman.required' => 'waktu mulai wajib diisi',
            'tgl_tutup_pengumuman.required' => 'waktu selesai wajib diisi'
        ]);

        if (is_null($request->adanya_kelulusan)) {
            $validated['adanya_kelulusan'] = 1;
        } else
            $validated['adanya_kelulusan'] = 0;

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

        if (is_null($request->adanya_kelulusan)) {
            $validated['adanya_kelulusan'] = 1;
        } else
            $validated['adanya_kelulusan'] = 0;

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
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);

        return view('/admin/form-event');
    }
}
