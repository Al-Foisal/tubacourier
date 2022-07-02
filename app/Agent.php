<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model {
    public function nearestZone() {
        return $this->belongsTo(Nearestzone::class, 'area', 'id');
    }
}
