<?php

namespace DeskFlix\PayPal;

use DeskFlix\Events\PayPalPaymentApproved;
use DeskFlix\Models\Plan;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payee;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;

class PaymentClient
{
    /**
     * @var ApiContext
     */
    private $apiContext;


    /**
     * PaymentClient constructor.
     */
    public function __construct(ApiContext $apiContext)
    {
        $this->apiContext = $apiContext;
    }

    public function doPayment(Plan $plan){

        $event = new PayPalPaymentApproved($plan);
        event($event);
        return $event->getOrder();
    }

    public function makePayment(Plan $plan){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $duration = $plan->duration == Plan::DURATION_MONTHLY ? 'Mensal' : 'Anual';
        $item = new Item();
        $item->setName("Plano $duration")
            ->setSku($plan->sku)
            ->setCurrency('BRL')
            ->setQuantity(1)
            ->setPrice($plan->value);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($plan->value);

        $amount = new Amount();
        $amount->setCurrency('BRL')
            ->setTotal($plan->value)
            ->setDetails($details);

        $payee = New Payee();
        $payee->setEmail(env('PAYPAL_PAYEE_EMAIL'));

        $transaction = new Transaction();
        $transaction
            ->setAmount($amount)
            ->setDescription("Pagamento do plano de assinatura")
            ->setPayee($payee)
            ->setInvoiceNumber(uniqid());

        $baseUrl = url('/');
        $redirecturls = new RedirectUrls();
        $redirecturls
            ->setReturnUrl("$baseUrl/payment/success")
            ->setCancelUrl("$baseUrl/payment/cancel");

        $payment = new Payment();
        $payment
            //->setExperienceProfileId($plan->webProfile->code)
            ->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirecturls)
            ->setTransactions([$transaction]);
        //dd($payment);
        //$payment->create($this->apiContext);

        try{
            $payment->create($this->apiContext);
        } catch (PayPalConnectionException $exception){
            \Log::error($exception->getMessage(), ['data' => $exception->getData()]);
            throw $exception;
        }

        return $payment;
    }

}