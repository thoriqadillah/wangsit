<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Services\AdminService;
use App\Services\DepartementService;
use App\Services\UserService;
use Livewire\Component;
use Livewire\WithPagination;

class Root extends Component
{
    use WithPagination;

    //TODO: implement update karena masih ngebug
    
    //untuk nambah admin
    public $searchedUser;
    public $toAdd = false;
    public $selectedDept = 1;
    public $search;
    
    //untuk mount
    public $departements;
    public $perPage = 20;
    public $userDept;

    protected AdminService $adminService;
    protected UserService $userService;
    protected DepartementService $departementService;

    public function boot(AdminService $adminService, UserService $userService, DepartementService $departementService) {
        $this->adminService = $adminService;;
        $this->userService = $userService;;
        $this->departementService = $departementService;;
    }

    public function mount() {
        $this->departements = $this->departementService->getAll();
        $this->userDept = $this->userService->getUserDept();
        if ($this->userDept) return abort(404);
    }
    
    public function updatedSearch() {
        $this->searchedUser = $this->adminService->searchUser($this->search);
    }

    public function setAdmin() {
        $admin = $this->adminService->assignAdmin($this->searchedUser->id, $this->selectedDept);
        $dept = $this->departementService->getDept('id', $admin['data']->departement_id);
        return redirect()->to('/admin/root')->with('success', 'Berhasil menjadikan ' . $this->searchedUser->nama . ' sebagai admin departement ' . $dept->nama);
    }
    
    public function deleteAdmin(int $id) {
        $this->adminService->unassignAdmin($id);
        $user = $this->userService->getUserById($id);
        session()->flash('success', 'Berhasil menghapus ' . $user->nama . ' sebagai admin');
    }

    public function isAdding() {
        $this->toAdd = !$this->toAdd;
    }
    
    public function render() {
        $data = ['admins' => $this->adminService->getAdmin($this->perPage)];

        return view('livewire.admin.root', $data)
            ->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');;
    }
}
