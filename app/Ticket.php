<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    public function users()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function trips()
    {
        return $this->belongsTo(Trip::class, 'trip');
    }

    public function departure_stations()
    {
        return $this->belongsTo(Station::class, 'departure_station');
    }

    public function arrival_stations()
    {
        return $this->belongsTo(Station::class, 'arrival_station');
    }
}
