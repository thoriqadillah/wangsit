<?php

namespace App\Http\Controllers;

use App\Models\AcademyCategory;
use App\Services\AcademyService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AcademyController extends Controller
{
    public $userDept;

    protected AcademyService $academy;
    protected UserService $userService;

    public function __construct(AcademyService $academyService, UserService $userService)
    {
        $this->academy = $academyService;
        $this->userService = $userService;
    }
    
    public function showAcademy()
    {
        $academy =  $this->academy->showAcademy();
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);

        $data = [
            'academy' => $academy,
            'userDept' => $this->userDept
        ];

        return view('admin/admin-academy', $data);
    }

    public function detailAcademy($slug)
    {
        $detail = $this->academy->detailAcademy($slug);
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);
        if (!$detail) return abort(404);
        
        $kategoriMateri = AcademyCategory::all();
        $data = [
            'detail' => $detail,
            'materi' => $kategoriMateri
        ];

        return view('admin/form-academy', $data);
    }

    public function addAcademyPage()
    {
        $kategoriMateri = AcademyCategory::all();
        $this->userDept = $this->userService->getUserDept();
        if (!$this->userDept) return abort(404);

        $data = [
            'materi' => $kategoriMateri
        ];

        return view('admin/form-academy', $data);
    }

    public function addAcademy(Request $request)
    {
        $validated = $request->validate([
            'academy_category_id' => 'required',
            'nama' => 'required',
            'link' => 'required',
        ], [
            'required' => ':attribute wajib diisi',
            'academy_category_id.required' => 'kategori wajib diisi'
        ]);

        $academy = $this->academy->addAcademy($validated);
        if ($academy) {
            return redirect('/admin/academy')->with('success', 'Academy berhasil ditambah');
        }

        return redirect()->refresh()->withErrors(['error' => 'Academy gagal ditambah']);
    }

    public function updateAcademy(Request $request, int $id)
    {
        $validated = $request->validate([
            'academy_category_id' => 'required',
            'nama' => 'required',
            'link' => 'required',
        ], [
            'required' => ':attribute wajib diisi',
            'academy_category_id.required' => 'kategori wajib diisi'
        ]);

        $academy = $this->academy->updateAcademy($validated, $id);
        if ($academy) {
            return redirect('/admin/academy')->with('success', 'Academy berhasil diupdate');
        }

        return redirect()->refresh()->withErrors(['error' => 'Academy gagal diupdate']);
    }

    public function deleteAcademy(int $id)
    {
        $deleted = $this->academy->deleteAcademy($id);
        if ($deleted) {
            return redirect()->back()->with('success', 'Academy berhasil dihapus');
        }

        return redirect()->refresh()->withErrors(['error' => 'Academy gagal dihapus']);
    }
}
