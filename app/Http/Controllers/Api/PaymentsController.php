<?php

namespace DeskFlix\Http\Controllers\Api;

use DeskFlix\Http\Requests\OrderRequest;
use DeskFlix\Models\Plan;
use DeskFlix\PayPal\PaymentClient;
use DeskFlix\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    /**
     * @var PaymentClient
     */
    private $paymentClient;

    public function __construct(PaymentClient $paymentClient)
    {
        $this->paymentClient = $paymentClient;
    }

    public function store(OrderRequest $request, Plan $plan)
    {
        //dd($plan);
        $order = $this->paymentClient->doPayment($plan);
        return $order;

    }

}
