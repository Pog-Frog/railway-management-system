<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    //
    public function lines()
    {
        return $this->belongsTo(Lines::class, 'line');
    }

    public function types()
    {
        return $this->belongsTo(Train_type::class, 'type');
    }

    public function captains()
    {
        return $this->belongsTo(Captain::class, 'captain');
    }

}
