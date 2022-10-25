<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Services\AdminService;
use App\Services\UserService;
use Livewire\Component;

class Root extends Component
{
    //TODO: implementasikan logic root
    public $searchedUser;
    public $toAdd = false;
    public $admins;
    public $departements;
    public $search;
    public $selectedDept = 1;
    public $isUpdate = false;

    protected AdminService $adminService;
    protected UserService $userService;

    public function boot(AdminService $adminService, UserService $userService) {
        $this->adminService = $adminService;;
        $this->userService = $userService;;
    }

    public function mount() {
        $this->admins = $this->adminService->getAdmin();
        $this->adminCount = count($this->admins);
        $this->departements = Departement::all();
    }
    
    public function updatedSearch() {
        $this->searchedUser = $this->adminService->searchUser($this->search);
    }
    
    public function setAdmin() {
        $this->adminService->assignAdmin($this->searchedUser->id, $this->selectedDept);
        return redirect()->to('/admin/root')->with('success', 'Berhasil menjadikan ' . $this->searchedUser->nama . ' sebagai admin');
    }
    
    public function updatedtoAdd() {
        $this->admins = $this->adminService->getAdmin();
    }
    
    public function deleteAdmin(int $id) {
        $this->adminService->unassignAdmin($id);
        $user = $this->userService->getUserById($id);
        $this->admins = $this->adminService->getAdmin();
        session()->flash('success', 'Berhasil menghapus ' . $user->nama . ' sebagai admin');
    }

    public function isAdding() {
        $this->toAdd = true;
    }
    
    public function render() {
        return view('livewire.admin.root')
            ->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');;
    }
}
