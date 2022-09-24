<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assigned_Trains_for_Lines extends Model
{
    public function captains()
    {
        return $this->belongsTo(Captain::class, 'captain');
    }

    public function lines()
    {
        return $this->belongsTo(Line::class, 'line');
    }

    public function trains()
    {
        return $this->belongsTo(Train::class, 'train');
    }

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'admin');
    }
}
