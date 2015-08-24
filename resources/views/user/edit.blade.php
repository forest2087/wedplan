@extends('app')


@section('content')
    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['user.update', $user->id] ]) !!}



    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=> 'form-control']) !!}


        {!! Form::label('billing_address', 'Billing Address:') !!}
        {!! Form::text('billing_address', null, ['class'=> 'form-control']) !!}


        {!! Form::label('city', 'City:') !!}
        {!! Form::text('city', null, ['class'=> 'form-control']) !!}


        {!! Form::label('province', 'Province:') !!}
        {!! Form::text('province', null, ['class'=> 'form-control']) !!}


        {!! Form::label('country', 'Country:') !!}
        {!! Form::text('country', null, ['class'=> 'form-control']) !!}

        {!! Form::label('postal_code', 'Postal Code:') !!}
        {!! Form::text('postal_code', null, ['class'=> 'form-control']) !!}

        {!! Form::label('phone', 'Phone:') !!}
        {!! Form::text('phone', null, ['class'=> 'form-control']) !!}


        {!! Form::label('gender', 'Gender:') !!}
        {!! Form::text('gender', null, ['class'=> 'form-control']) !!}


        {!! Form::label('dob', 'Date of Birth:') !!}
        {!! Form::text('dob', null, ['class'=> 'form-control']) !!}


        {{--allow edit user role for admin--}}
        @if(Auth::user()->role_id>1)
            {!! Form::label('role_id', 'Role ID:') !!}
            {!! Form::text('role_id', null, ['class'=> 'form-control']) !!}

            {!! Form::label('plan', 'Plan:') !!}
            {!! Form::text('plan', null, ['class'=> 'form-control']) !!}
        @endif
    </div>

    {!! Form::submit('Update Profile', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop