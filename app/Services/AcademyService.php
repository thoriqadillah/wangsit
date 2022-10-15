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

    public function addAcademy(array $academyData)
    {
        // $add = Academy::create([
        //     'nama' => $academyData['nama'],
        //     'kategori' => $academyData['kategori'],
        //     'link' => $academyData['link'],
        //     'thumbnail' => $academyData['thumbnail'],
        // ]);

        // return $add;

        return Academy::create([
            'nama' => $academyData['nama'],
            'kategori' => $academyData['kategori'],
            'link' => $academyData['link'],
            'thumbnail' => $academyData['thumbnail'],
        ]);
    }

    public function updateAcademy(array $academyData, int $id)
    {
        $update = Academy::where('id', $id)->update([
            'nama' => $academyData['nama'],
            'kategori' => $academyData['kategori'],
            'link' => $academyData['link'],
            'thumbnail' => $academyData['thumbnail'],
        ]);

        return $update;
    }

    public function deleteAcademy(int $id): bool
    {
        $academy = Academy::find($id);
        return $academy->delete();
    }
}
