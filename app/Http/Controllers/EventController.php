<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    protected EventService $event;

    public function __construct(EventService $eventService) {
        $this->event = $eventService;
    }

    public function index() {
        $event = $this->event->showEvent();
    }

    public function showByDepartement(int $departementId) {
        $event = $this->event->showBy('departement_id', $departementId);
    }

    public function showDetail(string $slug) {
        $event = $this->event->showBy('slug', $slug);
        if ($event->isEmpty()) return abort(404);

    }

    public function addEvent(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
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

        $event = $this->event->addEvent($validated);
        if ($event) {
            return redirect('/event')->with('status', 'Event berhasil ditambah');
        }

        return redirect()->refresh()->withErrors(['status' => 'Event gagal ditambah']);
    }

    public function updateEvent(Request $request, int $id) {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
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

        $updEvent = $this->event->updateEvent($validated, $id);
        if ($updEvent) {
            return redirect()->back()->with('status', 'Event berhasil diupdate');
        }

        return redirect()->refresh()->withErrors(['status' => 'Event gagal diupdate']);
    }

    public function deleteEvent(int $id) {
        $deleted = $this->event->deleteEvent($id);
        if ($deleted) {
            return redirect()->back()->with('status', 'Event berhasil dihapus');
        }
        
        return redirect()->refresh()->withErrors(['status' => 'Event gagal dihapus']);
    }
}
