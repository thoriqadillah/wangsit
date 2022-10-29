<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'departement_id'];

    public function departement() {
        return $this->hasOne(Departement::class, 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->orderBy('nama');
    }
}
