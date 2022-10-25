<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use GuzzleHttp\Promise\Create;

class AdminService
{

    public function getAdmin() {
        return User::with('admin')
            ->whereNotNull('admin_id')
            ->get();
    }

    public function searchUser($query) {
        return User::where(function($q) use ($query) {
            $q->where('nama', 'like', "%$query%");
            $q->orWhere('nim', 'like', "%$query%");
        })->whereNull('admin_id')->first();
    }

    public function unassignAdmin(int $id)
    {
        return User::where('id', $id)->update([
            'admin_id' => null
        ]);
    }

    public function assignAdmin(int $id, int $deptId)
    {
        $admin = Admin::where('departement_id', $deptId)->first();

        return User::where('id', $id)->update([
            'admin_id' => $admin->id
        ]);
        
    }
}
