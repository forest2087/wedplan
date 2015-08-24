@extends('app')


@section('content')
    {{--list users for admin--}}
    @if(Auth::user()->role_id>1)
        <h1>List of Users</h1>
        <table class="table">
            <thead>
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>Email</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)

                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="{{ url('/user/'.$user->id . '/edit')}}">Edit</a></td>
                </tr>

            @endforeach
            </tbody>
        </table>
    @else
        Nothing to see here. Check out our <a href="{{ url('/product')}}">product page</a>.
    @endif
@stop
