<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EventLulusStatus extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'user_id', 'status_lulus'];

    protected $casts = [
        'status_lulus' => 'boolean'
    ];

    public function scopeUser($query) {
        return $query->where('user_id', Auth::id());
    }
}
