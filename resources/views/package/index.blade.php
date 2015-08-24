@extends('app')

@section('css')
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
@stop


@section('content')


    <div class="pricing">
        <div class="package free">
            <h1>LITE</h1>

            <div class="plan-price"> FREE
                <div class="term">forever</div>
            </div>
            <ul>
                <li><strong>50</strong> email invites</li>
                <li>Simple RSVP system</li>
                <li><a href="/product/lite">Learn More</a></li>

            </ul>
            <a class="button" href="/auth/register">Start now</a>
        </div>


        <div class="package selected highlighted">
            <h1>BETTER</h1>

            <div class="plan-price"> $<span class="basic">29</span>99
                <div class="term">monthly</div>
            </div>
            <ul>
                <li><strong>200</strong> email invites</li>
                <li>Enhanced RSVP system</li>
                <li>Wedding registry with Paypal</li>
                <li><a href="/product/better">Learn More</a></li>
            </ul>
            <a class="button" href="/pay/better">Buy now</a>
        </div>


        <div class="package">
            <h1>BEST</h1>

            <div class="plan-price"> $<span class="basic">49</span>99
                <div class="term">monthly</div>
            </div>
            <ul>
                <li><strong>Unlimited</strong> customizable email invites</li>
                <li>Customizable RSVP system</li>
                <li>Wedding registry with Paypal & Retailer</li>
                <li>Photo Album & Share</li>
                <li><a href="/product/best">Learn More</a></li>
            </ul>
            <a class="button" href="/pay/best">Buy now</a>
        </div>
    </div>

@stop
