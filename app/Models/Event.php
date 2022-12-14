<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['departement_id', 'slug', 'nama', 'tgl_buka_pendaftaran', 'tgl_tutup_pendaftaran', 'tgl_buka_pengumuman', 'tgl_tutup_pengumuman', 'thumbnail', 'adanya_kelulusan'];

    protected $casts = [
        'tgl_buka_pendaftaran'  => 'datetime',
        'tgl_tutup_pendaftaran'  => 'datetime',
        'tgl_buka_pengumuman'  => 'datetime',
        'tgl_tutup_pengumuman'  => 'datetime',
        'adanya_kelulusan' => 'boolean'
    ];

    public function form() {
        return $this->hasOne(EventForm::class, 'event_id');
    }

    public function graduees() {
        return $this->hasMany(EventLulusStatus::class, 'event_id')->where('user_id', Auth::id());
    }
}
