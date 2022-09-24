<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Can_stop extends Model
{
    public function trains()
    {
        return $this->belongsTo(Train::class, 'train');
    }

    public function stations()
    {
        return $this->belongsTo(Station::class, 'station');
    }
}
