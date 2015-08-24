<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index($id=null) {



        return view('payment.index', [
            'content' => 'Payment page for ' . $id . ' package',
            'stripe_key'=>env('STRIPE_KEY'),
            'product' => $id
        ]);
    }

    public function process(Request $request) {

        $customerInfo = '';
        $billingInfo = array('amount'=>'49.99');
        $product = $request->input('product');
        $token = $request->input('stripeToken');
        $charge = array();
        $errorObj = array();

        //Process Stripe API charge
        //USING PASS BY REFERENCE TO RETURN TWO SETS OF ARRAYS
        Payment::processStripe($customerInfo, $billingInfo, $product, $token, $charge, $errorObj);

        if (isset($charge['paid']) && $charge['paid'] == 1) {
            //save transaction
            Payment::create([
                'stripe_id' => $charge['id'],
                'amount' => $charge['amount']/100,
                'currency' => $charge['currency']
            ]);

            //return success page
            return view('payment.success', [
                'content' => $charge,
            ]);
        } else {
            //return fail page
            return view('payment.failed', [
                'content' => $errorObj,
            ]);
        }



    }

}