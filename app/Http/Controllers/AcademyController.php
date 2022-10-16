<?php

namespace App\Http\Controllers;

use App\Services\AcademyService;
use Illuminate\Http\Request;

class AcademyController extends Controller
{
    //
    protected AcademyService $academy;

    public function __construct(AcademyService $academyService)
    {
        $this->academy = $academyService;
    }

    public function showAcademy()
    {
        $this->academy->showAcademy();
    }

    public function addAcademy(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'link' => 'required',
            'thumbnail' => 'required',
        ], [
            'required' => ':attribute wajib diisi'
        ]);

        $academy = $this->academy->addAcademy($validated);
        if ($academy) {
            return redirect('/academy')->with('status', 'Academy berhasil ditambah');
        }

        return redirect()->refresh()->withErrors(['status' => 'Academy gagal ditambah']);
    }

    public function updateAcademy(Request $request, int $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'link' => 'required',
            'thumbnail' => 'required',
        ], [
            'required' => ':attribute wajib diisi',
        ]);

        $academy = $this->academy->updateAcademy($validated, $id);
        if ($academy) {
            return redirect('/academy')->with('status', 'Academy berhasil diupdate');
        }

        return redirect()->refresh()->withErrors(['status' => 'Academy gagal diupdate']);
    }

    public function deleteAcademy(int $id)
    {
        $deleted = $this->academy->deleteAcademy($id);
        if ($deleted) {
            return redirect()->back()->with('status', 'Academy berhasil dihapus');
        }

        return redirect()->refresh()->withErrors(['status' => 'Academy gagal dihapus']);
    }
}
