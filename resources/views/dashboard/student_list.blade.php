@extends('main')
@section('right-side-nav')
    <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('main-content')

<table class="table table-hover" style="width: 100%;">
    <tr>
        <th scope="col">Student ID</th>
        <th scope="col">Student Name</th>
        <th scope="col">Status </th>
        <th scope="col">Actions</th>
    </tr>
    @foreach($userCollection as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td class="icons"><a href="{{ route('user.delete',$user->id) }}" title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt=""></a></td>
            <td class="icons"><a href="{{ route('user.delete',$user->id) }}" title="Delete Module"><button type="button" class="btn btn-primary">View Details</button></a></td>
        </tr>
    @endforeach
</table>
@stop
@section('css-style')
        img {
           height: 30px;
           width: 30px; 
        } 

        table {
            margin: 50px;
            justify-content: center;
            align-items: center;
            font-family: verdana;
        } 

        .icons > a {
            margin-left: 1.5rem;
        }

         #nav-links {
            text-align: center;
        } 
@stop