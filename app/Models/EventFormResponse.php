<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFormResponse extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'user_id', 'response'];

    protected $casts = [
        'response' => 'array',
    ];
}
