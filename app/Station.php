<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function admins()
    {
        return $this->belongsTo(Admin::class, 'admin');
    }
}
