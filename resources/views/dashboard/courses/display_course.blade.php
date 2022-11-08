@extends('main')
@extends('dashboard/courses/create')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Deleting this course would also remove all of its contents. Are you sure you want to proceed?</span>
@stop

@section('modal-title')
    Delete Course
@stop

@section('css-style')
    .layout{
        padding: 20px;
        display: flex;
        flex-grow: 1;
        flex-direction: row;
    }
    .course-content-area{
        display: flex;
        flex-grow: 1;
        flex-direction: column;
    }
    img{
        height: 30px;
        width: 30px; 
    } 
    .card:hover{
        cursor:pointer;
    }
    .course-area{
        margin: 0 auto;
        display: flex;
        flex-grow: 1;
        flex-direction: row;
        justify-content:left;
        gap: 15px;
        <!-- background-color: #2196F3; -->
        padding: 20px; 
        
    }
    .action{
        position: absolute;
        bottom: 0px;
        right: 20px;
    }
    .action-delete{
        position: absolute;
    bottom: 0px;
    right: 50px;
    }
    .header{
        display:flex;
        margin: 30 auto;
        width: 800px;
        border: 1 solid;
    }
    .empty-course{
        text-align:center;
        margin: 0 auto;
        justify-content:center;
        width: 700px;
        border: 1 solid;
    }
    .upper-left-header{
        margin: 20px;
        
    }
    nav{
        box-shadow: 0px 0px 0px 0px;
    }
    
    #create-button{
        transition: transform 250ms;
    }
    #create-button:hover{
        cursor:pointer;
        transform: translateY(-1px);
        box-shadow: 0 1px 5px rgb(0 0 0 / 0.2);
    }
    

@stop

@section('main-content')
@include('navbar/navbar_inside', ['courseId' =>  request()->route('courseid'), 'topiccontentid' => request()->route('topiccontentid') ])

    <div class="justify-content-center" style="width: 500px; height: 30px; margin: 0 auto;">
        @if(session('message'))
            <div class="alert alert-success align-items-center" role="alert" style="margin: 0 auto;">
                <div class="d-flex justify-content-between">
                    <div></div>
                    <div>
                        {{ session('message') }}
                    </div>
                    <div>
                        <button type="button" class="btn-close btn-close-black me-2 m-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                
            </div>
        @endif
    </div>
        <div class="justify-content-center" style="width: 1000px; margin: 30px auto; padding: 5px;">
            @if(count($ownedCourses) != 0)
                <div class="container text-center">
                    <div class="row row-cols-3 g-3" id="courseArea">

                    </div>
                </div>
            @else
                    <div class="col" style="width:fit-content;">
                        <a title="Add course" data-bs-toggle="modal" data-bs-target="#createCourse" data-bs-whatever="@fat">
                            <div class="card" style="width: 19em;height: 15em; border: none;">
                                <div class="card text-center" id="create-button" style="border: none;">
                                    <div class="card-body">
                                        <img style="width: 100px; height: 100px; margin: 50px auto;" src="{{ asset('images/add-icon.png') }}" alt="" >
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <div class="empty-course">
                    <h1>You dont have any courses posted.</h1>
                </div>
            @endif
    </div>
    <script>
        $(document).ready(function(){
            $(window).on('load', 
                getCourses(),
                console.log('otin'),
            );

            $('#createCourseButton').click(function (e) {
                var route = "{{route('course.create')}}";
                console.log(route);
                console.log($('#course_title').val());
                console.log($('#course_description').val());
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {
                        course_title: $('#course_title').val(),
                        course_description: $('#course_description').val(),
                    },
                    success: function (response) {
                        console.log('success');
                        getCourses();
                        $('#course_title').val('');
                        $('#course_description').val('');
                    },
                    error: function (response) {
                        console.log(response);
                        console.log('error');
                    }
                });
            });

            function getCourses(){
                var route = "{{route('course.getAll')}}";
                $.ajax({
                    type: "GET",
                    url: route,
                    dataType: "json",
                    success: function (response) {
                        displayCourse(response);
                    },
                    error: function (response){
                        console.log(response);
                    }
                });
            }
            function displayCourse(courses){
                console.log('These are the courses');

                let courseArea = document.getElementById('courseArea');
                courseArea.innerHTML=``;
                courseArea.innerHTML = `
                                            <div class="col">
                                                <a title="Add course" data-bs-toggle="modal" data-bs-target="#createCourse" data-bs-whatever="@fat">
                                                    <div class="card" style="width: 19em;height: 15em; border: none;">
                                                        <div class="card text-center" id="create-button" style="border: none;">
                                                            <div class="card-body">
                                                                <img style="width: 100px; height: 100px; margin: 50px auto;" src="{{ asset('images/add-icon.png') }}" alt="" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            `;
                for(x in courses){
                    // courseArea.innerHTML += `Hello`;
                    
                    courseArea.innerHTML += `
                                        <div class="col">
                                            <div class="card" style="width: 19em;height: 15em;">
                                                <div class="card-body" >
                                                    <h5 class="card-title">${courses[x].course_title}</h5>
                                                    <p class="card-text">${courses[x].course_description}</p>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <td class="icons"><a href="/teacher/course/${courses[x].course_id}/home" title="View Course"><img src="{{ asset('images/add.png') }}" alt=""></a></td>
                                            </div>
                                            <div class="action-delete" style="margin:2px;">
                                                <td class="icons"><a href ="/teacher/course/${courses[x].course_id}/delete" title="Delete Course"><img src="{{ asset('images/delete.png') }}" onclick="return confirm('Are you sure you want to delete this course?');"></a></td>
                                            </div>
                                        </div>
                                    
                                    `;
                    console.log(courses[x].course_title);
                }
            }
        });
        

    </script>

@stop



