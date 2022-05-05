<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Captain extends Model
{
    //
    public function trains()
    {
        return $this->hasOne(Train::class);

    }
}
