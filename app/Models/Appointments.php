<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    //
    protected $fillable = [
        'user_id',
        'appointment_time',
        'meeting_mode',
        'phone',
        'email'
    ];


    //relationship to foreignkey     
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
