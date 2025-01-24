<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = ['user_id', 'start_time', 'end_time'];

    public function appointment()
    {
        return $this->hasOne(Appointments::class);
    }
}
