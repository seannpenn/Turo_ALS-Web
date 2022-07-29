@extends('main')
@section('right-side-nav')
    <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">{{Auth::user()->username}}</a>
     <a class="nav-link" style="color: black;" href="{{route('user.logout')}}">Logout</a>
@stop

@section('main-content')
<table>
        <tr>
            <th>User ID</th>
            <th>UserName</th>
            <th>User Email </th>
        </tr>
        @foreach($userCollection as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td class="icons"><a href="{{ route('user.delete',$user->id) }}" title="Delete Student Entry"><img src="{{ asset('images/delete.png') }}" alt=""></a></td>

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
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: verdana;
        } */

        .icons > a {
            margin-left: 1.5rem;
        }

        /* #nav-links {
            text-align: center;
        } */
@stop