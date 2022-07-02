<?php

use App\Agent;
use App\Deliveryman;

function deliverymanbyid($id) {
    $man = Deliveryman::find($id);

    return $man;
}

function agentbyid($id) {
    $man = Agent::find($id);

    return $man;
}

function picbyid($id) {
    $man = pickup::find($id);

    return $man;
}
