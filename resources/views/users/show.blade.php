@extends('layouts.app')

@section('content')

    <title>User management</title>


<div class="container">

<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('users') }}">View All users</a></li>
        <li><a href="{{ URL::to('users/create') }}">Create a user</a>
    </ul>
</nav>

<div class="jumbotron text-center">
        <h2>{{ $user->name }}</h2>
        <p>
            <strong>Email:</strong> {{ $user->email }}<br>
            <strong>role:</strong> {{ $user->role }}
            <strong>phone:</strong> {{ $user->phone }}
            <strong>verified:</strong> {{ $user->verified }}
        </p>
    </div>




@endsection


