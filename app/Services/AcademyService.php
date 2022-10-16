<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Academy;
use PhpParser\ErrorHandler\Collecting;
use Illuminate\Database\Eloquent\Collection;

class AcademyService
{

    public function showAcademy()
    {
        return Academy::all();
    }

    public function detailAcademy($id)
    {
        return Academy::where('id', $id)->first();
    }


    public function addAcademy(array $academyData)
    {
        $add = Academy::create([
            'academy_category_id' => $academyData['academy_category_id'],
            'nama' => $academyData['nama'],
            'link' => $academyData['link'],
        ]);

        return $add;
    }

    public function updateAcademy(array $academyData, int $id)
    {
        $update = Academy::where('id', $id)->update([
            'academy_category_id' => $academyData['academy_category_id'],
            'nama' => $academyData['nama'],
            'link' => $academyData['link'],
        ]);

        return $update;
    }

    public function deleteAcademy(int $id): bool
    {
        $academy = Academy::find($id);
        return $academy->delete();
    }
}
