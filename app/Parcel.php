<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model {
    protected $fillable = ['invoiceNo', 'recipientName', 'recipientAddress', 'recipientPhone', 'merchantId', 'merchantAmount', 'merchantDue', 'cod', 'productWeight', 'note', 'trackingCode', 'deliveryCharge', 'codCharge', 'orderType', 'codType', 'percelType', 'status', 'reciveZone'];

    public function deliverymen() {
        return $this->belongsTo(Deliveryman::class, 'deliverymanId', 'id');
    }

    public function agentman() {
        return $this->belongsTo(Agent::class, 'agentId', 'id');
    }

    public function merchant() {
        return $this->belongsTo(Merchant::class, 'merchantId', 'id');
    }

    public function nearestZone() {
        return $this->belongsTo(Nearestzone::class, 'reciveZone', 'id');
    }

    public function PT() {
        return $this->belongsTo(Parceltype::class, 'status', 'id');
    }

}
