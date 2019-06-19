<?php

namespace DeskFlix\PayPal;

use DeskFlix\Events\PayPalPaymentApproved;
use DeskFlix\Models\Plan;

class PaymentClient
{
    public function doPayment(Plan $plan){

        $event = new PayPalPaymentApproved($plan);
        event($event);
        return $event->getOrder();
    }

}