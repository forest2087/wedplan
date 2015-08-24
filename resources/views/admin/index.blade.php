@extends('app')



@section('content')

    //only allow user with admin role to access admin dashboard
    @if (Auth::user()->role_id>1)

        <h1>List of Payments</h1>
        <table class="table">
            <thead>
            <tr>
                <td>Stripe ID</td>
                <td>Amount</td>
                <td>Currency</td>
                <td>Transaction Time</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($payments as $payment)

                <tr>
                    <td>{{$payment->stripe_id}}</td>
                    <td>{{ $payment->amount}}</td>
                    <td>{{ $payment->currency}}</td>
                    <td>{{ $payment->created_at}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    @else
        Sorry, you do not have the permission to access admin dashboard.
    @endif
@stop
