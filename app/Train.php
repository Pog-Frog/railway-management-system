<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    public function admins()
    {
        return $this->belongsTo(Admin::class, 'admin');
    }
}
