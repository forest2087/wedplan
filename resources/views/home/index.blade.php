@extends('app')

@section('css')
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
@stop


@section('content')
    <div class="row">
        <div class="rsvps form col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <h1 class="text-center">Simplify your wedding planning</h1>

            <p class="text-center">While gifts are appreciated, please know that your well wishes &amp; presence is a
                present
                enough.
                If you do want to give, you can fund our honeymoon via Paypal.</p>

            <form method="post" target="_top" action="pay" style="margin-bottom:100px;">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                <button type="submit" class="btn btn-default btn-lg btn-block"
                        style="max-width:300px; margin: 20px auto;">
                    Send Money with Paypal
                </button>
            </form>
        </div>
    </div>

@stop
