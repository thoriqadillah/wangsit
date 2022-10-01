<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFormResponse extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'event_form_id', 'user_id', 'response', 'checkbox_response'];

    protected $casts = [
        'checkbox_response' => 'array',
    ];
}
