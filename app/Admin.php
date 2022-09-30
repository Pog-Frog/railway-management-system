<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    //
    use HasFactory, HasApiTokens;
    use Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
    ];
}
