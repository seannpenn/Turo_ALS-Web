@extends('main')


@section('main-content')
<div class="layout">
    <form class="row g-1 searchBar">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchBar" aria-label="Text input with dropdown button" placeholder="Search.." style="width: 50%;">
                <select class="form-select" id="userType">
                    <option selected disabled>Filter..</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>
        </div>
        <div class="col-auto">
            <a class="btn mb-3" id="reset" style="background-color:orange;">Reset</a>
        </div>
    </form>
    <table class="table table-hover" style="width: 70%;">
        <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">UserName</th>
                <th scope="col">User Email </th>
                <th scope="col">User Type </th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($userCollection as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->userType == 0)
                            admin
                        @elseif($user->userType == 1)
                            teacher
                        @else
                            student
                        @endif
                    </td>
                    <td >
                        <a href="{{ route('user.delete',$user->id) }}" title="Delete Module"><img src="{{ asset('images/delete.png') }}" alt=""></a>
                        <a href="" title="View Profile"><button type="button" class="btn" style="background-color:orange;">View Profile</button></a>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        $(window).on('load', 
            updateTable(),
        );
        var userType = document.getElementById('userType');
        var resetButton = document.getElementById('reset');
        
                
                resetButton.addEventListener("click", function() {
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf('') > -1)
                    });
                    updateTable();
                });
                userType.addEventListener("change", function() {
                    var userType = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(userType) > -1)
                    });
                });

        function updateTable(){
            

            $("#searchBar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        }
        
    });
</script>
@stop
@section('css-style')
        img {
           height: 20px;
           width: 20px; 
        } 

        table {
            margin: 0 auto;
            justify-content: center;
            align-items: center;
            font-family: verdana;
            text-align: center;
        } 

        .icons > a {
            margin-left: 1.5rem;
        }

         #nav-links {
            text-align: center;
        }
        .searchBar{
            margin: 30px auto;
            width: 70%;
            justify-content: left;
        }
        
@stop