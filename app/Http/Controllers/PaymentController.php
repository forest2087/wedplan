<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Payment/Checkout page
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function index($id='best') {
        //todo - get price from database based on the product selected
        switch ($id) {
            case 'better':
                $total = 29.99;
                break;
            case 'best':
                $total = 49.99;
                break;
            default :
                $total = 49.99;
                break;
        }

        return view('payment.index', [
            'content' => 'Payment page for ' . strtoupper($id) . ' package. $'. $total . ' USD will be charged on your credit card.',
            'stripe_key'=>env('STRIPE_KEY'),
            'product' => $id
        ]);
    }

    /**
     * Process payment through stripe api, write data to database if successful
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function process(Request $request) {


        //todo - get price from database based on the product selected
        switch ($request->input('product')) {
            case 'better':
                $total = 29.99;
                break;
            case 'best':
                $total = 49.99;
                break;
        }


        $customerInfo = Auth::user();
        //todo - calculate tax, maybe have tax model to calculate based on country/province/currency
        //todo - calculate remit, maybe have remit model to calculate based on client type
        //$billingInfo is accounting related data, useful for reports generation
        $billingInfo = array('total'=>$total, 'tax'=>'', 'remit'=>'');
        $product = $request->input('product');
        $token = $request->input('stripeToken');
        $charge = array();
        $errorObj = array();

        //Process Stripe API charge
        //USING PASS BY REFERENCE TO RETURN TWO SETS OF ARRAYS
        Payment::processStripe($customerInfo, $billingInfo, $product, $token, $charge, $errorObj);

        //success
        if (isset($charge['paid']) && $charge['paid'] == 1) {
            //save transaction
            Payment::create([
                'stripe_id' => $charge['id'],
                'amount' => $charge['amount']/100,
                'currency' => $charge['currency'],
                'product' => $product
            ]);

            //update user plan
            $user = Auth::user();
            $user->plan = $product;
            $user->plan_starts = Carbon::now();
            $user->plan_ends = Carbon::now()->addMonth(1);
            $user->save();

            //todo - email receipt, welcome to the service

            //return success page
            return view('payment.success', [
//                'content' => $charge,
                'product' => $product
            ]);
        //failed transaction
        } else {
            //todo - email declined receipt
            //return fail page
            return view('payment.failed', [
                'content' => $errorObj,
            ]);
        }



    }

}