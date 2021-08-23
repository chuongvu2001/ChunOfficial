<?php

namespace App\Http\Controllers;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends Controller
{
    public function execute(){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AZFVo4kkBXGsr_RX7usR32BaeVBhrP5BVzXOokW8ovylY5DanStz8ummjt_k8In_FpQaIMcxVYedYrxs',     // ClientID
                'EA_57QzSifiUWHEVmMy_mXKjI-KNQZ6wcS9N0mBqoSj8XeqFrxQvEPSLaxw8YYdC49xufJDZCXBufnT9'      // ClientSecret
            )
        );
        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId,$apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerId'));
        $transaction = new Transaction();
        $amount = new Amount();
        $details =new Details();

        $details->setShipping('1.2')
            ->setTax('1.3')
            ->setSubtotal('17.50');

        $amount->setCurrency('USD');
        $amount->setTotal('20');
        $amount->setDetails($details);

        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);
        $result = $payment->execute($execution,$apiContext);
        dd($result);
    }
}
