<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    public function trains()
    {
        return $this->belongsTo(Train::class, 'train');
    }

    public function captains(){
        return $this->belongsTo(Captain::class, 'captain');
    }
}
