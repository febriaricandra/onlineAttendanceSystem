<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table='attendance';
    protected $fillable = [
        'id_user',
        'id_event',
        'isAttend',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event', 'id');
    }
}
