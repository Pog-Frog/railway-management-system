<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function captains()
    {
        return $this->belongsTo(Captain::class, 'captain');
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee');
    }

    public function lines()
    {
        return $this->belongsTo(Line::class, 'line');
    }
}
