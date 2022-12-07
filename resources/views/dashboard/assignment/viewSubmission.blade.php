@extends('main')

@section('css-style')
    .breadHeader{
        padding-top: 50px;
        padding-left: 50px;
    }
    .layout{
        max-width: 1200px;
        margin: 0 auto;
        word-wrap: break-word;
    }
@endsection

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid') ])
@include('dashboard.assignment.markAssignment')
    <nav aria-label="breadcrumb" class="breadHeader">
        <ol class="breadcrumb" style="background-color:white;">
            <li class="breadcrumb-item "><a href="/teacher/course/{{ request()->route('courseid') }}/assignment/{{ request()->route('assignmentid') }}">Assignment {{ request()->route('assignmentid') }}</a></li>
            <li class="breadcrumb-item " aria-current="page">{{ $chosenStudent->student_lname }}, {{ $chosenStudent->student_fname }} {{ $chosenStudent->student_mname }}</li>
            <li class="breadcrumb-item " aria-current="page">submissions</li>
        </ol>
    </nav>
    <div class="layout">
            <div class="" style="margin-bottom: 10px;">
                <button type="button" class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#markAssignment1">Overall Mark</button>
            </div>
            <br>
            <br>
            <table class="table table table-bordered" style="width: 100%;">
                <tr class="bg-light">
                    <th scope="col" class="text-left">Submission ID</th>
                    <th scope="col" class="text-left">submission</th>
                    <th scope="col" class="text-center">Submission date </th>
                <tbody >
                @foreach($studentSubmission as $key => $submission)
            
                        <tr style="border-bottom: 2px solid black;">
                            <td width="10%" class="text-start p-3">
                                    <p>{{ $submission->submission_id }}</p>
                            </td>
                            <td width="80%">
                                @if($submission->submission_type == 1)
                                    {!! $submission->submission_text->text !!}
                                @else
                                    @foreach($submission->submission_file as $file_path)
                                        @php
                                            $file_type = explode(".", $file_path->path);
                                        @endphp

                                        @if($file_type[1] == 'jpg')
                                            <a target="_blank" href="{{ asset($file_path->path) }}">
                                                <img class="img-fluid submittedImage" src="{{ asset($file_path->path) }}" image-key="{{ $key }}" width="100" height="100">
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td width="10%" class="text-center p-3">
                                <p class="fs-6">{{ $submission->created_at }}</p>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@endsection