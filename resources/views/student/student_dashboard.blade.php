@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
        background-color:yellow;
    }
    .header{
        <!-- margin:15px; -->
    }
    .upper-area{
        margin-bottom: 10px;
    }
    .bottom-area{
        width: 1200px;
        margin: 0 auto;
        <!-- padding: 5px; -->
    }
    .courses-area{
        <!-- margin: 5px; -->
        width: 800px;
        
    }
    .announcement-area{
        <!-- margin: 5px; -->
        <!-- width: 300px; -->
    }
    .card{
        <!-- width: 25em; -->
    }
@stop

@section('main-content')
@include('navbar/navbar_inside')

    @if(!empty($courseCollection))
    
    <div class="d-flex flex-column mb-3 layout">
        <div class="upper-area">
            <div class="shadow p-3 mb-2 bg-body rounded header">
                <h1>What to put?</h1>
            </div>
        </div>

        <div class="d-flex justify-content-between gap-2 bottom-area">
            <div class="shadow p-3 mb-2 bg-body rounded courses-area">
                <div class="container text-center" style="width: 800px; height: 600px;">
                    <!-- <h2>My Courses</h2> -->
                    <div class="row row-cols-2 g-4">
                        @foreach($courseCollection as $course)
                            <div class="col">
                                <div class="card">
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="140" xmlns="http://www.w3.org/2000/svg" 
                                    role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="40%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>

                                    <div class="card-body">
                                        <a href=""><h3><p class="text-start">{{$course['course_title']}}</p></h3></a>
                                        <!-- <h3 class="card-title">{{$course['course_title']}}</h3> -->
                                        <p class="card-text">{{$course['course_description']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="140" xmlns="http://www.w3.org/2000/svg" 
                                    role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="40%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>

                                    <div class="card-body">
                                        <a href=""><h3><p class="text-start">{{$course['course_title']}}</p></h3></a>
                                        <!-- <h3 class="card-title">{{$course['course_title']}}</h3> -->
                                        <p class="card-text">{{$course['course_description']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="140" xmlns="http://www.w3.org/2000/svg" 
                                    role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="40%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>

                                    <div class="card-body">
                                        <a href=""><h3><p class="text-start">{{$course['course_title']}}</p></h3></a>
                                        <!-- <h3 class="card-title">{{$course['course_title']}}</h3> -->
                                        <p class="card-text">{{$course['course_description']}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="shadow p-3 mb-2 bg-body rounded announcement-area">
                <div class="container text-center">
                    <h2>Announcements</h2>
                    <p>Testing announcements</p>
                    <p>Testing announcements</p>
                    <p>Testing announcements</p>
                    <p>Testing announcements</p>
                    <p>Testing announcements</p>
                </div>
            </div>
        </div>
    </div>
    
    @else
        <h1> Courses Unavailable.</h1>
    @endif
@stop

