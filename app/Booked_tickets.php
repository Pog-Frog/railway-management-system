<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booked_tickets extends Model
{
    public function stops_stations()
    {
        return $this->belongsTo(Stops_stations::class, 'stops_station');
    }

    public function seats()
    {
        return $this->belongsTo(Seat::class, 'seat');
    }
}
