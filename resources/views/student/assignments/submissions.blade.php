@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
    }
    .submittedImage {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 150px;
    }

    .submittedImage:hover {
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        cursor:pointer;
    }
@endsection

@section('main-content')
@include('navbar/navbar_inside', ['courseId' => request()->route('courseid') ])

    <nav aria-label="breadcrumb" class="breadHeader">
        <ol class="breadcrumb" style="background-color:white;">
            <li class="breadcrumb-item "><a href="{{route('student.assignmentDisplay', request()->route('courseid'))}}">Assignment list</a></li>
            <li class="breadcrumb-item " aria-current="page">My submissions</li>
        </ol>
    </nav>
    <div class="layout">
        <h1>My submission</h1>
            <div class="container text-center p-4">
                <div class="col align-self-center">
                    @if($assignmentSubmissions->count() != 0)
                        <table class="table table table-bordered" style="width: 100%;">
                            <tr class="bg-light">
                                <th scope="col" class="text-left">Submission ID</th>
                                <th scope="col" class="text-left">submission</th>
                                <th scope="col" class="text-center">Submission date </th>
                            <tbody >
                            @foreach($assignmentSubmissions as $key => $submission)
                        
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
                    @else
                        <h2>No submissions found.</h2>
                    @endif
                </div>
            </div>
    </div>
    
@endsection
<script>
    var coll = document.getElementsByClassName("collapsible");
        $(coll[0]).click(function (e) {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "none") {
            content.style.display = "none";
            } else {
            content.style.display = "block";
            }
        });
</script>