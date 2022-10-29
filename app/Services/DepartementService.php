<?php

namespace App\Services;

use App\Models\Departement;

class DepartementService {
  
  public function getAll() {
    return Departement::all();
  }

  public function getDept(string $column, $value) {
    return Departement::where($column, $value)->first();
  }
}