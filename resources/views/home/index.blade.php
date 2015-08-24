@extends('app')

@section('css')
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
@stop


@section('content')
    <div class="row" style="margin-top:100px;">
        <div class="rsvps form col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
            <h1 class="text-center">Simplify your wedding planning</h1>

            <p class="text-center">Are you overwhelmed with your wedding planning? Have you decided to go with paper invites or email invites? RSVP lost in the mail? How can I send out a email to all my guests? </p>

                <a href="/product">
                <button type="submit" class="btn btn-default btn-lg btn-block"
                        style="max-width:300px; margin: 20px auto;">
                    Check out what we can offer you
                </button></a>

        </div>
    </div>

@stop
