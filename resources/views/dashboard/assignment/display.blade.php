@extends('main')

{{-- @section('main-content')
    <form action="{{ route('assignment.create') }}" method="POST" class="row g-3 needs-validation" novalidate style="margin: 0 auto; width: 50%;">
        {{ csrf_field() }}

        <input type="text" class="form-control" id="validationCustom03" name="course_id" value="{{ request()->route('courseid') }}">
        <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Assignment title</label>
        <input type="text" class="form-control" id="validationCustom01" name="assignment_title" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        </div>
        <div class="col-md-6">
        <label for="validationCustom03" class="form-label">Assignment description</label>
        <input type="text" class="form-control" id="validationCustom03" name="assignment_description" required>
        <div class="invalid-feedback">
            Please provide a valid city.
        </div>
        </div>
        <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
@endsection --}}

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    table {
        justify-content: center;
        align-items: center;
        font-family: verdana;
        
    } 
    .upper-left-header{
        margin-left: 30px;
        margin-top: 30px;
        
    }
    .create-button{
        width: 150px;
        line-height:50px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
        
    }
    .create-button:hover{
        line-height:50px;
        background-color:orange;
        color: white;
        border: 0;
        border-radius: 10px;
    }
    
    img {
           height: 20px;
           width: 20px; 
        } 

@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid') ])
@include('dashboard/assignment/createModal')
@include('dashboard/assignment/updateModal')
    
    <div class="layout">
        <h1>Assignment List</h1>
        
            <div class="container text-center p-4">
                <div class="toast-container position-fixed top-0 start-50 translate-middle-x">
                    <div id="liveToast" class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                        <div class="image">
                            <img src="{{ asset('images/correct.png') }}" class="rounded me-2" alt="...">
                        </div>
                        <strong class="me-auto header">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            
                        </div>
                    </div>
                </div>
                <div class="col align-self-center">
                    @if($assignmentCollection->count() != 0)
                        <div class="d-flex flex-row mb-3">
                            <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#assignmentModal{{request()->route('courseid')}}" data-bs-whatever="@fat">Create Assignment</button>
                        </div>
                        <table class="table table-hover table table-bordered text-center" style="width: 100%;">
                            <tr>
                                <th scope="col" class="text-center">Assignment Title</th>
                                <th scope="col">Status </th>
                                <th scope="col">Action </th>
                            <tbody>
                            @foreach($assignmentCollection as $index => $assignment)
                                <tr>
                                    <td width="75%" class="text-start p-3">
                                        <p>{{ $assignment->assignment_title }}</p>
                                        
                                    </td>
                                    <td class="text-center p-3 statusContainer" index ="{{ $index }}">
                                        
                                    </td>
                                    <td class="text-center p-3">
                                        {{-- <a title="Edit Quiz"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#assignmentUpdateModal{{request()->route('courseid')}}" style="background-color:lightgreen;border: 1px solid lightgreen;"><img src="{{ asset('images/edit.png') }}" alt="" ></button></a> --}}
                                        <a href="/teacher/course/{{ $assignment->course_id }}/assignment/{{ $assignment->assignment_id }}" title="Edit Quiz"><button class="btn btn-warning" style="background-color:lightgreen;border: 1px solid lightgreen;"><img src="{{ asset('images/edit.png') }}" alt="" ></button></a>
                                        <a href="{{ route('assignment.delete', $assignment->assignment_id) }}" title="Delete Assignment" onclick="return confirm('Are you sure you want to delete assignment {{ $assignment->assignment_title }}');"><button class="btn btn-danger"><img src="{{ asset('images/delete.png') }}" alt="" ></button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="d-flex flex-row mb-3">
                            <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#assignmentModal{{request()->route('courseid')}}" data-bs-whatever="@fat">Create Assignment</button>
                        </div>
                        <h2>No created assignment..</h2>
                    @endif
                    </div>
                </div>
            </div>  

    <script>
        const toastLiveExample = document.getElementById('liveToast');

        function activate(assignment,index){
                        var activateAssignmentRoute =  "/teacher/assignment/" + assignment + "/activate";
                        const toast = new bootstrap.Toast(toastLiveExample);
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                }
                            });
                            $.ajax({
                                    url: activateAssignmentRoute,
                                    type: 'post',
                                    dataType: 'json',
                                    success: function(response){
                                        console.log(response.data.status);
                                        if(response.data.status == "inactive"){
                                            $(".toast-body").html('Assignment is now inactive.');
                                            toast.show();
                                        }
                                        else{
                                            $(".toast-body").html('Assignment is now active.');
                                            toast.show();
                                        }
                                        loadAssignments();
                                    },
                                    error: function(error){
                                        console.log(error);
                                        $('header').html('Error');
                                        $('.image').html(`
                                            <img src="{{ asset('images/wrong.png') }}" class="rounded me-2" alt="...">
                                        `);
                                        $(".toast-body").html('Please complete setting up the assignment first.');
                                                        
                                        toast.show();
                                        loadAssignments();
                                    }
                            });
            }


            $(window).on('load', 
                // getAllQuizzes()
                loadAssignments(),
                toggleSwitch(),
            );

            function loadAssignments(){
                var courseid = {{request()->route('courseid')}};
                var route =  "/teacher/course/" + courseid +"/assignments";

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        'request': "request from ajax"
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        displayAssignment(response.data);
                    },
                    error: function (response) {
                        alert('Hello');
                        console.log(response);
                        
                    }
                });
            }

            function displayAssignment(assignmentCollection){
                const status = document.getElementsByClassName("statusContainer");
                
                for(x=0;x<status.length;x++){
                    if(assignmentCollection[x].status == 'active'){
                        $(status[x]).html(`
                            <div class="badge bg-success text-wrap" style="width: 100%;">
                                ${assignmentCollection[x].status}
                            </div>
                                                    
                            <div class="form-check form-switch toogleSwitch">
                                <input class="form-check-input activate" value="${assignmentCollection[x].assignment_id}" index ="${x}"  type="checkbox" role="switch" id="flexSwitchCheckChecked" checked onclick="activate(${assignmentCollection[x].assignment_id},${x})">
                            </div>
                        `);
                    }
                    else{
                        $(status[x]).html(`
                        <div class="badge bg text-wrap" style="width: 100%; background-color:grey;">
                            ${assignmentCollection[x].status}
                        </div>
                                                
                        <div class="form-check form-switch toogleSwitch">
                            <input class="form-check-input activate" value="${assignmentCollection[x].assignment_id}" index ="${x}"  type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="activate(${assignmentCollection[x].assignment_id},${x})">
                        </div>
                    `);
                    }
                    
                }
            }

            
            function toggleSwitch(){
                const toggle = document.getElementsByClassName("activate");
                const toggleContainer = document.getElementsByClassName("toogleSwitch");
                
                for(x=0;x<toggle.length;x++){
                    $(toggle[x]).change(function(e){
                        var index = this.getAttribute('index');
                        var assignmentId = this.value;
                        var activateAssignmentRoute =  "/teacher/assignment/" + assignmentId + "/activate";
                        const toast = new bootstrap.Toast(toastLiveExample);
                        // var activateQuizRoute = "{{route('quiz.activate', ":quizid")}}";
                        // activateQuizRoute.replace(':quizid', $quizId);
                            
                            console.log(activateAssignmentRoute);
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                }
                            });
                            $.ajax({
                                    url: activateAssignmentRoute,
                                    type: 'post',
                                    dataType: 'json',
                                    success: function(response){
                                        alert('hello');
                                        console.log(response);
                                        if(response.data.status == 'active'){
                                            $(".toast-body").html('Assignment is now active.');
                                            $(status[index]).html(`
                                                <div class="badge bg-success text-wrap" style="width: 100%;">
                                                    ${response.data.status}
                                                </div>
                                                
                                                <div class="form-check form-switch toogleSwitch">
                                                    <input class="form-check-input activate" value="${response.data.assignment_id}" index ="${index}"  type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                                </div>
                                            `);

                                            toast.show();
                                        }
                                        else{
                                            $(".toast-body").html('Assignment is now inactive.');

                                            $(status[index]).html(`
                                                <div class="badge bg text-wrap" style="width: 100%; background-color:grey;">
                                                    ${response.data.status}
                                                </div>
                                                
                                                <div class="form-check form-switch toogleSwitch">
                                                    <input class="form-check-input activate" value="${response.data.assignment_id}" index ="${index}"  type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                </div>
                                            `);

                                            toast.show();
                                        }
                                        // window.location.reload();
                                    },
                                    error: function(response){
                                        console.log('Hello');
                                        $('header').html('Error');
                                        $('.image').html(`
                                            <img src="{{ asset('images/wrong.png') }}" class="rounded me-2" alt="...">
                                        `);
                                        $(".toast-body").html('Please complete setting up the assignment first.');
                                        
                                        toast.show();
                                        // window.location.reload();
                                        console.log(error);
                                    }
                            });
                    });
                }
            }
    </script>
    
@stop
