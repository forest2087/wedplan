<?php

namespace App;
use Jenssegers\Mongodb\Model as Eloquent;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class Payment extends Eloquent
{

    protected $collection  = 'payments';
    protected $connection = 'mongodb';

    protected $fillable = ['stripe_id', 'amount', 'currency'];

    public static function processStripe($customerInfo, $billingInfo, $product, $token, &$charge, &$errorObj)
    {

        try {
            $charge = Stripe::charges()->create([
//            'customer' => $_POST['billing_member'].uniqid(),
                'card' => $token,
                'currency' => 'USD',
                'amount' => $billingInfo['amount'],
                "description" => "WedPlan Payment",
                "statement_descriptor" => "WedPlan " . $product . " package",
                "metadata" => array(
                    'product' => $product,
                    'customerInfo' => json_encode($customerInfo),
                    'billingInfo' => json_encode($billingInfo),
                ),
            ]);
        } catch (\Cartalyst\Stripe\Exception\BadRequestException $transErrObj) {
            // This exception will be thrown when the data sent through the request is mal formed.
        } catch (\Cartalyst\Stripe\Exception\UnauthorizedException $transErrObj) {
            // This exception will be thrown if your Stripe API Key is incorrect.
        } catch (\Cartalyst\Stripe\Exception\InvalidRequestException $transErrObj) {
            // This exception will be thrown whenever the request fails for some reason.
        } catch (\Cartalyst\Stripe\Exception\NotFoundException $transErrObj) {
            // This exception will be thrown whenever a request results on a 404.
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $transErrObj) {
            // This exception will be thrown whenever the credit card is invalid.
//            // Get the status code
//            $errorObj[] = $transErrObj->getCode();
//
//            // Get the error message returned by Stripe
//            $errorObj[] = $transErrObj->getMessage();
//
//            // Get the error type returned by Stripe
//            $errorObj[] = $transErrObj->getErrorType();
        } catch (\Cartalyst\Stripe\Exception\ServerErrorException $transErrObj) {
            // This exception will be thrown whenever Stripe does something wrong.
        }

        $errorObj = ((isset($transErrObj)) ? $transErrObj->getMessage() : array());
    }
}