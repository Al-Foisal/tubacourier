<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model {
    public function parcels() {
        return $this->hasMany(Parcel::class, 'merchantId', 'id');
    }

    protected $fillable = [
        'password',

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
