<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['departement_id', 'slug', 'name', 'deskripsi', 'start_date', 'end_date', 'thumbnail', 'spreadsheet_url'];
}
