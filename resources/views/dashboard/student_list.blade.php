@extends('main')

@section('css-style')
        img {
           height: 20px;
           width: 20px; 
        } 
        .layout{
            padding: 50px;
        }

        .icons > a {
            margin-left: 1.5rem;
        }

        #nav-links {
            text-align: center;
        } 
        .searchBar{
            margin: 0 auto;
            margin-left: 20px;
            width: 70%;
            justify-content: center;
        }
        table {
            margin: 0 auto;
            justify-content: center;
            align-items: center;
            font-family: verdana;
            text-align: center;
        } 
@stop

@section('main-content')
@include('navbar/navbar_inside')
    <div class="layout">
        

        @if(count($enrollees) != 0)
        <h3>Location: {{Auth::user()->teacher->location->loc_city}}, {{Auth::user()->teacher->location->loc_name}}</h3>
            <form class="row g-1 searchBar">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="searchBar" aria-label="Text input with dropdown button" placeholder="Search.." style="width: 50%;">
                        <select class="form-select" id="userType">
                            <option selected disabled>Filter by...</option>
                            <option value="teacher">year</option>
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
                        <th scope="col">Student ID</th>
                        <th scope="col">Student LRN</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Status </th>
                        <th scope="col">Program enrolled </th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @foreach($enrollees as $enrollee)
                        <tr>
                            <th scope="row">{{ $enrollee->student_id }}</th>
                            @if( $enrollee->student->information->LRN != null)
                                <td>{{ $enrollee->student->information->LRN }}</td>
                            @else 
                                <td>no LRN</td>
                            @endif
                            <td>{{ $enrollee->student->student_lname }}, {{ $enrollee->student->student_fname }} {{ $enrollee->student->student_mname }}</td>
                            <td>{{ $enrollee->status }}</td>
                            <td>{{$enrollee->program->prog_fname}}</td>
                            <td>
                                <a href="{{ route('student.application',$enrollee->student_id) }}" title="Delete Student Record"><button type="button" class="btn btn-warning" style="color:white;">View application</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
        @else
            <h3>No Student Records found.</h3>   
        @endif
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

