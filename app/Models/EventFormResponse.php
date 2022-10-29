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

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
