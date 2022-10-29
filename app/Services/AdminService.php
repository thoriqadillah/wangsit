<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class AdminService
{

    public function getAdmin($perPage) {
        return Admin::with('user')
            ->whereNotNull('departement_id')
            ->paginate($perPage);
    }

    public function searchUser($query) {
        return User::where(function($q) use ($query) {
            $q->where('nama', 'like', "%$query%");
            $q->orWhere('nim', 'like', "%$query%");
        })->where('id', '!=', 1)
        ->first();
    }

    public function unassignAdmin(int $userId)
    {
        $admin = Admin::where('user_id', $userId)->first();
        return $admin->delete();
    }

    public function assignAdmin(int $id, int $deptId)
    {
        $admin = Admin::where('user_id', $id)->first();
        if ($admin) {
            $admin->departement_id = $deptId;
            $result = $admin->save();

            return [
                'data' => $admin,
                'status' => 'updated'
            ];
        }

        $result = Admin::create([
            'user_id' => $id,
            'departement_id' => $deptId
        ]);

        return [
            'data' => $result,
            'status' => 'created'
        ];
    }

    public function updateAdmin(int $id, int $deptId) {
        return User::where('id', $id)->update([
            'admin_id' => $deptId + 1 //admin id adalah dept id + 1
        ]);
    }
}
