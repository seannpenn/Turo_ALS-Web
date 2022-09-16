@extends('main')


@section('main-content')
<table class="table table-hover" style="width: 100%;">
    <tr>
        <th scope="col">User ID</th>
        <th scope="col">UserName</th>
        <th scope="col">User Email </th>
        <th scope="col">Actions</th>
    </tr>
    @foreach($userCollection as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td class="icons"><a href="{{ route('user.delete',$user->id) }}" title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt=""></a></td>
            <td class="icons"><a href="" title="View Profile"><button type="button" class="btn btn-primary">View Profile</button></a></td>
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