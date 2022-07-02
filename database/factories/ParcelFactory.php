<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Parcel;
use Faker\Generator as Faker;

$factory->define(Parcel::class, function (Faker $faker) {
    $i = 1;

    return [
        'invoiceNo'            => ++$i,
        'merchantId'           => 1,
        'paymentInvoice'       => ++$i,
        'cod'                  => 500,
        'merchantAmount'       => 500,
        'merchantDue'          => 500,
        'merchantpayStatus'    => 1,
        'merchantPaid'         => 500,
        'recipientName'        => $faker->name,
        'recipientAddress'     => $faker->address,
        'recipientPhone'       => ++$i,
        'note'                 => $faker->sentence,
        'deliveryCharge'       => 50,
        'codCharge'            => 0,
        'productPrice'         => 500,
        'deliverymanId'        => 1,
        'deliverymanAmount'    => 200,
        'dPayinvoice'          => null,
        'deliverymanPaystatus' => null,
        'pickupmanId'          => null,
        'agentId'              => null,
        'agentAmount'          => null,
        'aPayinvoice'          => null,
        'agentPaystatus'       => null,
        'productWeight'        => 5,
        'trackingCode'         => ++$i,
        'percelType'           => 1,
        'helpNumber'           => null,
        'reciveZone'           => 2,
        'orderType'            => 2,
        'codType'              => 1,
        'sale_price'           => 555,
        'invoice_id'           => ++$i,
        'verifyToken'          => 1,
        'verifyStatus'         => 0,
        'status'               => 4,
    ];
});
