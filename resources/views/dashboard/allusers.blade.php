<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
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
</style>
<body>
    @include('navbar.navbar')
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
</body>
</html>