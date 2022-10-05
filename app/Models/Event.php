<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['departement_id', 'slug', 'nama', 'deskripsi', 'tgl_acara', 'start_date', 'end_date', 'thumbnail'];

    protected $casts = [
        'tgl_acara'  => 'datetime',
    ];

    public function forms() {
        return $this->hasMany(EventForm::class, 'event_id');
    }
}
