<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $fillable = [
        'password',
      
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
