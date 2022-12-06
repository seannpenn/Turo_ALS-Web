@extends('main')

@section('css-style')
    .breadHeader{
        padding-top: 50px;
        padding-left: 50px;
    }
    .displaySubmission{
        
        color: black;
        cursor: pointer;
        padding: 18px;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        cursor: pointer;
    }
@endsection

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid') ])
@include('dashboard/assignment/viewSubmissionModal')

    <nav aria-label="breadcrumb" class="breadHeader">
        <ol class="breadcrumb" style="background-color:white;">
            <li class="breadcrumb-item "><a href="{{route('assignment.display', request()->route('courseid'))}}">Assignment list</a></li>
            <li class="breadcrumb-item " aria-current="page">{{$chosenAssignment->assignment_title}}</li>
        </ol>
    </nav>
    <div class="layout">
        <div class="container p-3">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Edit</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class=" nav-link  btn btn-primary position-relative" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Student's submissions
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                        </span>
                    </button>
                </li>
            </ul>
            {{-- modal for successful --}}
            <div class="toast-container position-fixed top-0 start-50 translate-middle-x" style="margin-top: 10px;">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: white;">
                    <div class="toast-header">
                    <img src="{{ asset('images/correct.png') }}" class="rounded me-2" alt="..." style="height: 20px; width: 20px;">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Changes Saved.
                    </div>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    
                    {{-- start of file --}}
                    <div class="row" style="height: fit-content;">
                        <form class="d-flex" id="assignmentUpdate">
                            <div class="col-sm-6 col-md-7" >
                                <div class="p-3 border bg-light" style="min-height: 550px;">
                                    <div class="mb-3">
                                        <label for="formGroupExampleInput" class="form-label">Assignment title</label>
                                        <input type="text" class="form-control" id="assignment_title" placeholder="Enter title" value="{{ $chosenAssignment->assignment_title }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="formGroupExampleInput2" class="form-label">Assignment Instruction</label>
                                        {{-- <div class="form-group" >
                                            <textarea class="form-control editor" name="html" id="editor">{{ $chosenAssignment->assignment_description }}</textarea>
                                        </div> --}}
                                        <div class="form-group">
                                            <textarea class="ckeditor form-control" id="editor">
                                                {{ $chosenAssignment->assignment_description }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-5">
                                <div class="p-3 " style="min-height: 550px;">
                                    <div class="row">
                                        <div class="col-6">
                                            <h2 class="fs-5">Points</h2>
                                            <input class="form-control" type="number" name="points" id="points" value="{{ $chosenAssignment->points }}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <h2 class="fs-5">Start Date</h2>
                                            <input class="form-control" type="date" name="start_date" id="start_date" value="{{ $chosenAssignment->start_date }}">
                                        </div>
                                        <div class="col-6">
                                            <h2 class="fs-5">End Date</h2>
                                            <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $chosenAssignment->end_date }}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <h2 class="fs-5">Start Time</h2>
                                            <input class="form-control" type="time" name="start_time" id="start_time" value="{{ $chosenAssignment->start_time }}">
                                        </div>
                                        <div class="col-6">
                                            <h2 class="fs-5">End Time</h2>
                                            <input class="form-control" type="time" name="end_time" id="end_time" value="{{ $chosenAssignment->end_time }}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <h2 class="fs-5">Submission type</h2>
                                            <div class="form-check">
                                                <input class="form-check-input" value="1" type="radio" name="submission_type" id="submission_type" >
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                Text
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="2" type="radio" name="submission_type" id="submission_type">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                File
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="3" type="radio" name="submission_type" id="submission_type">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                Both
                                                </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </form>
                    </div>
                    {{-- end of file --}}
                </div>
                {{-- start of student submission file --}}
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <table class="table table-bordered" style="width: 100%;">
                    
                            <th scope="col" width="90%" >Student Name</th>
                            <th scope="col" width="10%">Action </th>
                        <tbody class="">
                            @foreach($enrolledStudents as $key => $enrolledStudent)
                                    <tr>
                                        <td class="text-left p-3">
                                            {{ $enrolledStudent->student->student_lname }}, {{ $enrolledStudent->student->student_fname }} {{ $enrolledStudent->student->student_mname }}
                                            <p style="font-size:small;">Submitted on May 20, 2001 5:00 PM</p>

                                        </td>
                                        <td style="justify-content: center;">
                                            <div class="d-grid gap-2 d-md-block">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#markAssignment1">Overall Mark</button>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="3" >
                                            <table class="table table-bordered ">
                                                <thead style="border: white;">
                                                    @if($chosenAssignment->submissionByStudent($enrolledStudent->student->student_id)->count() != 0)
                                                        <th scope="col" colspan="3" width="100%" class="displaySubmission" key="{{ $key }}">Submissions</th>
                                                    @else
                                                        <th scope="col" colspan="3" width="100%" class="displaySubmission" key="{{ $key }}">No submissions</th>
                                                    @endif
                                                </thead>
                                                <tbody class="table-group-divider submissionContent">
                                                        @foreach($chosenAssignment->submissionByStudent($enrolledStudent->student->student_id) as $key => $submission)
                                                            <tr>
                                                                <td width="80%">
                                                                    {{ $submission->submission_id }}
                                                                    <button type="button" value="{{ $enrolledStudent->student->student_id }}" class="btn btn-success viewSubmission" data-bs-toggle="modal" data-bs-target="#viewSubmissionModala">View submission</button>
                                                                </td>
                                                                <td width="15%">
                                                                    {{ $submission->created_at }}
                                                                </td>
                                                                <td>
                                                                    <div class="d-grid gap-2 d-md-block">
                                                                        <button type="button" class="btn btn-warning markSubmission" data-bs-toggle="modal" data-bs-target="#markAssignment{{$submission->submission_id}}">Mark</button>
                                                                    </div>
                                                                    @extends('dashboard.assignment.markAssignment')
                                                                </td>
                                                                <td width="5%">
                                                                    <a class="deleteSubmission" submissionId="{{ $submission->submission_id }}">
                                                                        <img src="{{ asset('images/delete.png') }}" width="20" height="20">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        <nav class="navbar fixed-bottom navbar-dark" style="box-shadow: 0 4px 20px rgb(0 0 0 / 0.2); ">
            <div class="container-fluid col-sm-6 col-md-8">
                <button type="button" class="btn btn-primary btn-lg saveButton">Save</button>
            </div>
        </nav>
        
    </div>
    
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        const toastLiveExample = document.getElementById('liveToast')
        const submissionByStudent = document.getElementsByClassName('viewSubmission');
        const deleteSubmission = document.getElementsByClassName('deleteSubmission');
        const markSubmission = document.getElementsByClassName('markSubmission');
        
        for(var a=0; a<submissionByStudent.length; a++){
            $(submissionByStudent[a]).click(function (e) {
                window.location.href = '/teacher/course/' + {{request()->route('courseid')}} + '/assignment/' + {{request()->route('assignmentid')}} +'/student/' + this.value +'/submission';
            });
            $(deleteSubmission[a]).click(function (e) {
                var submissionId = this.getAttribute('submissionId');
                alert(submissionId);
                window.location.href = '/teacher/submission/' + submissionId + '/delete';
            });
        }
        

        $(document).ready(function(){

            
            $('.saveButton').click(function (e) {
                alert($('#points').val());
                const editorData = editor.getData();
                e.preventDefault();
                var formData = {
                    'assignment_title' : $('#assignment_title').val(),
                    'assignment_description' : editorData,
                    'start_date' : $('#start_date').val().toString(),
                    'end_date' : $('#end_date').val(),
                    'start_time' : $('#start_time').val(),
                    'end_time' : $('#end_time').val(),
                    'submission_type': $("input[name='submission_type']:checked").val(),
                    'points' : $('#points').val(),
                };
                var updateAssignmentRoute = "/teacher/assignment/" + "{{request()->route('assignmentid')}}" + "/update";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    type: "POST",
                    url: updateAssignmentRoute,
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        const toast = new bootstrap.Toast(toastLiveExample);
                        toast.show();
                        console.log(response);
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });

            $('#submitScore').click(function (e) { 
                e.preventDefault();
                var formData = {
                    'total_score' : $('#total_score').val(),
                };
                const toast = new bootstrap.Toast(toastLiveExample);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/teacher/assignment/" + this.value + "/mark",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        $(".toast-body").html('Submission marked successfully.');
                        toast.show();
                        console.log(response);
                    },
                    error: function (response){
                        $(".toast-body").html('Submission marked unsuccessfully.');
                        toast.show();
                        console.log(response);
                    }
                });
            });
            

            

            
        });
    </script>
@endsection

