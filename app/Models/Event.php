<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table='events';
    protected $fillable = [
        'nama',
        'tempat',
        'deskripsi',
        'dateTime',
        'startTime',
        'endTime',
        'file',
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'id_event', 'id');
    }
}
