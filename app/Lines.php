<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lines extends Model
{
    //
    public function trains()
    {
        return $this->hasMany(Train::class);

    }
}
