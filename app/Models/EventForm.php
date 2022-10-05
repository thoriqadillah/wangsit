<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventForm extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'form_type_id', 'nama', 'judul', 'placeholder', 'value_options'];

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
