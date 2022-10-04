<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventForm extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'form_type_id', 'nama', 'judul', 'placeholder', 'value_options'];
}
