<?php

namespace App\Http\Controllers;

use App\Models\AcademyCategory;
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
        $academy =  $this->academy->showAcademy();

        $data = [
            'academy' => $academy
        ];

        return view('admin/admin-academy', $data);
    }

    public function detailAcademy($slug)
    {
        $detail = $this->academy->detailAcademy($slug);
        $kategoriMateri = AcademyCategory::all();
        $data = [
            'detail' => $detail,
            'materi' => $kategoriMateri

        ];

        return view('admin/add-academy', $data);
    }

    public function addAcademyPage()
    {
        $kategoriMateri = AcademyCategory::all();

        $data = [
            'materi' => $kategoriMateri
        ];

        return view('admin/add-academy', $data);
    }

    public function addAcademy(Request $request)
    {
        $validated = $request->validate([
            'academy_category_id' => 'required',
            'nama' => 'required',
            'link' => 'required',
        ], [
            'required' => ':attribute wajib diisi'
        ]);

        $academy = $this->academy->addAcademy($validated);
        if ($academy) {
            return redirect('/admin/academy')->with('status', 'Academy berhasil ditambah');
        }

        return redirect()->refresh()->withErrors(['status' => 'Academy gagal ditambah']);
    }

    public function updateAcademy(Request $request, int $id)
    {
        $validated = $request->validate([
            'academy_category_id' => 'required',
            'nama' => 'required',
            'link' => 'required',
        ], [
            'required' => ':attribute wajib diisi',
        ]);

        $academy = $this->academy->updateAcademy($validated, $id);
        if ($academy) {
            return redirect('/admin/academy')->with('status', 'Academy berhasil diupdate');
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
