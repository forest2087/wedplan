@extends('app')


@section('content')
    <h1>List of Users</h1>
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Email</td>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)

            <tr>
                <td>{{$user->id}}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
@stop
