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

    public function division() {
        return $this->belongsTo(Division::class);
    }

    public function district() {
        return $this->belongsTo(UpDistrict::class, 'up_district_id', 'id');
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function union() {
        return $this->belongsTo(Nearestzone::class, 'reciveZone', 'id');
    }

}
