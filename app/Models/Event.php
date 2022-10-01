<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['departement_id', 'slug', 'nama', 'deskripsi', 'start_date', 'end_date', 'thumbnail'];
}
