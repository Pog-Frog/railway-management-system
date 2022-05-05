<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train_type extends Model
{
    //
    public function trains()
    {
        return $this->hasMany(Train::class);

    }
}
