<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parceltype extends Model {
    public function parcel() {
        return $this->hasMany(Parcel::class, 'status', 'id');
    }
}
