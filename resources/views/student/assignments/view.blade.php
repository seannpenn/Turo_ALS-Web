@extends('main')

@section('css-style')
    .breadHeader{
        padding-top: 50px;
        padding-left: 50px;
    }
    .layout{
        margin: 0 auto;
        margin-bottom: 100px;
        max-width: 1200px;
    }

    .content {
        margin-top: 10px;
        padding: 5px;
        display: block;
        overflow: hidden;
    }
    
    
    
@endsection

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid') ])
    <nav aria-label="breadcrumb" class="breadHeader">
        <ol class="breadcrumb" style="background-color:white;">
            <li class="breadcrumb-item "><a href="{{route('student.assignmentDisplay', request()->route('courseid'))}}">Assignment list</a></li>
            <li class="breadcrumb-item " aria-current="page">{{$chosenAssignment->assignment_title}}</li>
        </ol>
    </nav>
    <div class="layout">
        <div class="d-flex justify-content-between" style="line-height: 20px;">
            <p class="fs-1 fw-bold">{{ $chosenAssignment->assignment_title}}</p>
            @if($chosenAssignment->multiple_submissions == 'true')
                <a href="/student/course/{{ request()->route('courseid') }}/assignment/{{ $chosenAssignment->assignment_id }}/submissions">
                    <button type="button" class="btn btn-primary position-relative">
                        view my submissions
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $chosenAssignment->submissions->count() }}
                        </span>
                    </button>
                </a>
                {{-- <button type="button" class="btn btn-outline-primary btn-sm">My other submissions <span class="badge text-bg-secondary">{{ $chosenAssignment->submissions->count() }}</span></button> --}}
            @endif

        </div>
        <hr>
        <br>
        <button type="button" class="btn btn-primary btn-sm collapsible dropdown-toggle">Assignment Instructions</button>
        <div class="content shadow-none p-3  bg-light rounded">
            {!! $chosenAssignment->assignment_description !!}
        </div>
        <div class="div">
            <p class="fs-4" style="margin-top: 20px;">Submission due date:</p>
            <p class="fs-6" style="margin-top: 20px;">{{ $chosenAssignment->end_date }}</p>
        </div>
        <br>
        @if($chosenAssignment->multiple_submissions == 'true')
        <form action="{{ route('student.submitAssignment', $chosenAssignment->assignment_id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" name="course_id" value="{{ request()->route('courseid') }}" hidden>
            <input type="text" name="submission_type" value="{{ $chosenAssignment->submission_type }}" hidden>
            <input type="text" name="assignment_id" value="{{ $chosenAssignment->assignment_id }}" hidden>

            @if($chosenAssignment->submission_type == 1)
                <div class="form-group">
                    <textarea class="ckeditor form-control" id="editor" name="text"></textarea>
                </div>
            @elseif($chosenAssignment->submission_type == 2)
                <div class="col-4">
                    <div class="input-group mb-3">
                        <input type="file" name="file[]" class="form-control" id="inputGroupFile02" style="width: 5px;" multiple>
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                </div>
            @else
                <div class="col-4">
                    <div class="input-group mb-3">
                        <input type="file" name="file[]" class="form-control" id="inputGroupFile02" style="width: 5px;" multiple>
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="editor" name="text"></textarea>
                </div>
            @endif

            <nav class="navbar fixed-bottom navbar-dark" style="box-shadow: 0 4px 20px rgb(0 0 0 / 0.2); ">
                <div class="container-fluid col-sm-6 col-md-8" style="max-width: 1200px;">
                    <button type="submit" value="{{ $chosenAssignment->assignment_id }}" class="btn btn-primary btn-lg submitButton">Submit</button>
                </div>
            </nav>
        </form>
        @else
            <p>Submitted. </p>
            
            <a href="/student/course/{{ request()->route('courseid') }}/assignment/{{ $chosenAssignment->assignment_id }}/submissions">
                <button type="button" class="btn btn-primary position-relative">
                    view my submissions
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $chosenAssignment->submissions->count() }}
                    </span>
                </button>
            </a>
        @endif
    </div>

    
    <script>
        var coll = document.getElementsByClassName("collapsible");
        $(coll[0]).click(function (e) {
            this.classList.toggle("active");
            
            var content = this.nextElementSibling;
            if (content.style.display === "none") {
            content.style.display = "block";
            } else {
            content.style.display = "none";
            }
        });
        $(document).ready(function(){
            

            // var route =  "/student/assignment/{assignmentid}/submit";
            // student.submitAssignment
            // const editorData = editor.getData();

            // $('.submitButton').click(function(){
            //     $assignmentId = this.value;

            //     $.ajax({
            //         type: "method",
            //         url: "url",
            //         data: "data",
            //         dataType: "dataType",
            //         success: function (response) {
                        
            //         }
            //     });
            // });
            
            
        });
    </script>
@endsection