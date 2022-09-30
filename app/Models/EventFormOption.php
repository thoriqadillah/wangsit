<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFormOption extends Model
{
    use HasFactory;

    protected $fillable = ['event_form_id', 'value', 'text'];
    
    protected $casts = [
        'value' => 'array',
        'text' => 'array',
    ];
}
