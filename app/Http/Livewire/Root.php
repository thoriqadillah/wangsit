<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Services\AdminService;
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

    protected AdminService $adminService;
    protected UserService $userService;

    public function boot(AdminService $adminService, UserService $userService) {
        $this->adminService = $adminService;;
        $this->userService = $userService;;
    }

    public function mount() {
        $this->departements = Departement::all();
    }
    
    public function updatedSearch() {
        $this->searchedUser = $this->adminService->searchUser($this->search);
    }

    public function setAdmin() {
        $this->adminService->assignAdmin($this->searchedUser->id, $this->selectedDept);
        return redirect()->to('/admin/root')->with('success', 'Berhasil menjadikan ' . $this->searchedUser->nama . ' sebagai admin');
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
