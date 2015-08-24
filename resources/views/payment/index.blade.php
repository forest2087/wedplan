@extends('app')

@section('js')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey('{{ $stripe_key }}');

        var stripeResponseHandler = function (status, response) {
            var aForm = $('#paymentForm');

            if (response.error) {
                //alert(response.error.message);
                // Show the errors on the form
                //aForm.find('.payment-errors').text(response.error.message);
                $('#ccAlert').html(response.error.message);
                $('#divCcAlert').show();
                aForm.find('button').prop('disabled', false);
                $('#paymentModal').modal('hide');
            } else {
                // token contains id, last4, and card type
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                aForm.append($("<input type='hidden' name='stripeToken' />").val(token));
                // and re-submit
                aForm.get(0).submit();
            }
        };

        jQuery(function ($) {
            $('#paymentForm').submit(function (e) {
                var aForm = $(this);

                $('#paymentModal').modal({backdrop: 'static'});

                // Disable the submit button to prevent repeated clicks
                aForm.find('button').prop('disabled', true);

                Stripe.card.createToken(aForm, stripeResponseHandler);

                // Prevent the form from submitting with the default action
                return false;
            });
        });

    </script>
@stop


@section('content')
    {{ $content }}


    <div class="well">
        <div id="cardInformation">
            <fieldset>
                <legend class="text-center">Supported Credit Cards</legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6 text-center">

                    <img src="{{ asset("img/visa_48.png") }}" title="Visa" alt="Visa">
                    <img src="{{ asset("img/mastercard_48.png") }}" title="Master Card" alt="Master Card">
                    <img src="{{ asset("img/amex_48.png") }}" title="American Express" alt="American Express">
                </div>
            </div>
            <div id="divCcAlert" class="row" style="display:none">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <div class="alert alert-danger text-center">
                        <i class="glyphicon glyphicon-map-marker"></i> <b><span id="ccAlert"></span></b>
                    </div>
                </div>
            </div>
            <form autocomplete="off" class="" id="paymentForm"
                  action="{{url('process')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="product" value="{{ $product }}">

                <div class="row">
                    <div class="col-xs-12">
                        <fieldset>
                            <legend>Payment Information</legend>
                            <div class="form-group">
                                <label class="" for="inpCcName">Name on Credit Card</label>
                                <input type="text" class="form-control required" id="inpCcName" data-stripe="name" value="test payment">
                            </div>
                            <div class="form-group">
                                <label class="" for="inpCcNum">Credit Card Number</label>
                                <input type="text" pattern="[0-9]*" class="form-control required" id="inpCcNum"
                                       data-stripe="number" value="4242424242424242">
                            </div>
                            <div class="form-group">
                                <label class="" for="inpCvv">CVV</label>
                                <input type="text" pattern="[0-9]*" class="form-control required" id="inpCvv"
                                       data-stripe="cvc" value="123">
                            </div>
                            <div class="form-group">
                                <label class="" for="selExpYear">Expiration Year</label>
                                <select class="form-control required" id="selExpYear" data-stripe="exp-year">
                                    {{--<option value="15">2015</option>--}}
                                    <option value="16">2016</option>
                                    <option value="17">2017</option>
                                    <option value="18">2018</option>
                                    <option value="19">2019</option>
                                    <option value="20">2020</option>
                                    <option value="21">2021</option>
                                    <option value="22">2022</option>
                                    <option value="23">2023</option>
                                    <option value="24">2024</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="" for="selExpMonth">Expiration Month</label>
                                <select class="form-control required" id="selExpMonth" data-stripe="exp-month">
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="" for="selBillingMember">Billing Member</label>
                                <select name="billing_member" class="form-control required" id="selBillingMember">
                                    <option value="{{ Auth::user()->name }}">{{ Auth::user()->name }}</option>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <input type="hidden" name="amount" value="100">

                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button class="btn btn-block btn-success">Process Transaction</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade payment-modal" id="paymentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="myModalLabel">Processing Transaction</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-offset-3 col-sm-6 text-center payment-loader">
                        <img src="{{ asset("img/loading_large.gif") }}" title="Loading" alt="Loading">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@stop
