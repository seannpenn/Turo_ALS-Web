@extends('main')

@section('css-style')
    .layout{
        max-width: 1200px;
        margin: 0 auto;
        <!-- background-color:yellow; -->
    }
    .header{
        height: 250px;
        <!-- margin:15px; -->
    }
    .upper-area{
        margin-bottom: 10px;
    }

    .courses-area{
        <!-- margin: 5px; -->
        width:auto;
        
    }
    .announcement-area{
        <!-- border-bottom: 5px solid orange; -->
        <!-- margin: 5px; -->
        <!-- width: 300px; -->  
    }
    .col .card{
        <!-- border-left: 3px solid orange; -->
        transition: transform 250ms;
    }
    .card:hover{
        border-left: 3px solid orange;
        cursor:pointer;
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }
    .card-title:hover{
        text-decoration: underline;
    }
@stop

@section('main-content')
@include('navbar/navbar_inside')

    @if(!empty($courseCollection))
    
    <div class="d-flex flex-column mb-3 layout">
        <div class="upper-area">
            <div class="shadow-sm p-3 mb-3 bg-body rounded header">
                <h1>Alternative Learning System Environment</h1>
                <h3>Program enrolled: </h3>
                <p>Basic Literacy Program</p>
                <h3>Learning outcomes: </h3>
                <p>Develop basic literacy skills of reading, writing and numeracy.</p>
            </div>
        </div>

        <div class="container text-center">
            <!-- Stack the columns on mobile by making one full-width and the other half-width -->
            
            <div class="row g-5">
                
                <div class="col-md-8 shadow-none p-3 mb-5 bg-light rounded">
                    <div class="row text-left">
                        <div class="col-md-8">
                            <h3>Courses</h3>
                        </div>
                    </div>
                    <div class="row row-cols-2 g-3">
                        @foreach($courseCollection as $course)
                            <div class="col">
                                <a href="{{ route('student.courseHome',$course['course_id'] )}}" class="viewCourse" style="text-decoration: none;">
                                    <div class="card" style="height: 12rem;">
                                        <svg style="border-bottom: 2px solid black;" class="bd-placeholder-img card-img-top" width="100%" height="75" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <title>Placeholder</title><rect width="100%" height="100%" fill="#FFFFFF"></rect><text x="40%" y="50%" fill="orange" dy=".3em">Image cap</text>
                                        </svg>
                                        <div class="card-body" style="text-align: left; text-decoration: none;">
                                            <h5 class="card-title">{{$course['course_title']}}</h5>
                                            <!-- <p class="card-text">{{$course['course_description']}}</p> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-6 col-md-4 ">

                    <div class="shadow-none p-3 mb-5 bg-light rounded">
                        <div class="container text-left shadow-none p-3 mb-5 bg-light rounded">
                            <ol class="list-group list-group-numbered">
                                <h2>Teacher profile</h2>    
                                <svg class="bd-placeholder-img rounded-circle" width="75" height="75" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Completely round image: 75x75" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Completely round image</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="22%" y="50%" fill="#dee2e6" dy=".3em">75x75</text></svg>
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row shadow-none p-3 mb-5 bg-light rounded" style="margin-top: 10px;">
                <div class="container text-left" >
                    <ol class="list-group list-group-numbered">
                        <h2>Announcements</h2>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                            <div class="fw-bold">Subheading</div>
                            Content for list item
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    
    @else
        <h1> Courses Unavailable.</h1>
    @endif

    <script>
        // $(window).focus(function() {
        //     //do something
        // });

        // $(window).blur(function() {
        //     alert('You changed to another tab.')
        // });

        $(document).ready(function(){
            $(window).on('load', 
                
            );

            
        });
        

    </script>
@stop

