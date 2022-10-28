<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Academy;
use Illuminate\Support\Str;
use PhpParser\ErrorHandler\Collecting;
use Illuminate\Database\Eloquent\Collection;

class AcademyService
{

    public function showAcademy()
    {
        return Academy::all();
    }

    public function detailAcademy($slug)
    {
        return Academy::where('slug', $slug)->join('academy_categories', 'academy_categories.id', '=', 'academy_category_id')->select('academies.*', 'academy_categories.nama as namaK')->first();
    }

    public function search(string $query) {
        return Academy::where('nama', 'like', "%$query%")->get();
    }

    public function addAcademy(array $academyData)
    {
        $hash = bin2hex(random_bytes(6));

        $add = Academy::create([
            'academy_category_id' => $academyData['academy_category_id'],
            'nama' => $academyData['nama'],
            'slug' => Str::slug($academyData['nama']) . '-' . $hash,
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
