<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Services\EventService;
use Error;
use Illuminate\Validation\Rules\File;
use Symfony\Contracts\Service\Attribute\Required;

class EventController extends Controller
{
    //
    protected EventService $event;

    public function __construct(EventService $eventService)
    {
        $this->event = $eventService;
    }

    public function detailEvent($slug)
    {
        $detail = $this->event->detailEvent($slug);
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
            return redirect('/admin/event')->with('status', 'Event berhasil ditambah');
        }
        return redirect()->refresh()->withInput()->withErrors(['status' => 'Event gagal ditambah']);
    }

    public function updateEvent(Request $request, int $id)
    {

        // dd($request->thumbnail);

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
            return redirect('/admin/event')->with('status', 'Event berhasil diupdate');
        }

        return redirect()->refresh()->withErrors(['status' => 'Event gagal diupdate']);
    }

    public function addEventPage()
    {
        $department = Departement::all();

        $data = [
            'departement' => $department
        ];
        return view('/admin/form-event', $data);
    }

    public function responseEvent($slug)
    {
        return view('/admin/form-response');
    }
}
