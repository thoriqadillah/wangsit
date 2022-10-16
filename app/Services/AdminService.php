<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use GuzzleHttp\Promise\Create;

class AdminService
{

    public function getAdmin()
    {
        return User::whereNotNull('admin_id')->get();
    }

    public function deleteAdmin(int $id)
    {
        $admin = User::whereNotNull('admin_id')->get();
        return $admin->delete();
    }

    public function assignAdmin(array $adminData)
    {

        $idUser = $adminData['id'];
        $idDept = $adminData['idDept'];

        // $idAdmin = [];
        foreach ($idDept as $id) {
            $admin = Admin::where('departement_id', $id)->first();
            $idAdmin = $admin->id;

            User::where('id', $idUser)->update([
                'admin_id' => $idAdmin
            ]);
        }
    }
}
