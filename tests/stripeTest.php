<?php

use App\Payment;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
class stripeTest extends TestCase
{
    /**
     * @expectedException Cartalyst\Stripe\Exception\MissingParameterException
     */
    public function testProcessStripeFail()
    {
//        mock data
        $customerInfo = array('name'=>'test fail');
        $billingInfo = array('total'=> '99');
        $product = 'test';
        $token = 'fake_token';
        $charge = array();
        $errorObj = array();

        //expect an exception because of a fake_token
        $this->setExpectedException(payment::processStripe($customerInfo, $billingInfo, $product, $token, $charge, $errorObj));

    }

    /**
     * test success transaction
     */
    public function testProcessStripeSuccess() {


        //mock data
        $customerInfo = array('name'=>'test success');
        $billingInfo = array('total'=> '99');
        $product = 'test';
        //generate real token
        $token = STRIPE::tokens()->create([
            'card' => [
                'number'    => '4242424242424242',
                'exp_month' => 6,
                'exp_year'  => 2019,
                'cvc'       => 314,
            ],
        ]);
        $charge = array();
        $errorObj = array();

        payment::processStripe($customerInfo, $billingInfo, $product, $token, $charge, $errorObj);

        //assert success payment
        $this->assertEquals(1, $charge['paid']);

    }
}