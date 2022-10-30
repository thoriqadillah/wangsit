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
    protected DepartementService $departmentService;

    public function __construct(EventService $eventService, UserService $userService, DepartementService $departmentService)
    {
        $this->event = $eventService;
        $this->userService = $userService;
        $this->departmentService = $departmentService;
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

        $department = $this->departmentService->getAll();

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
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);

        return view('/admin/form-event');
    }

    public function lulusEvent(Request $request, $eventId)
    {
        $dataLulus = $request->all();
        $update = $this->event->lulusEvent($dataLulus, $eventId);

        if ($update) {
            return redirect()->to('/admin/event')->with('success', 'Data peserta lulus berhasil diupdate');
        }
        return redirect()->refresh()->withErrors(['error' => 'Data peserta diupdate']);
    }
}
