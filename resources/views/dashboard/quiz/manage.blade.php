@extends('main')
@extends('dashboard/modals/createquestion_modal')
@extends('dashboard/modals/createquiz_modal')
@extends('modalslug')

@section('modal-content')
    <span id="modalContent"> Are you sure you want to delete this quiz?</span>
@stop

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

    
    <div class="layout">
        <h1>Quiz List</h1>
        
        <div class="container text-center p-4">
                <div class="toast-container position-fixed top-0 start-50 translate-middle-x">
                    <div id="liveToast" class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                        <img src="{{ asset('images/correct.png') }}" class="rounded me-2" alt="...">
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            
                        </div>
                    </div>
                </div>
            <div class="col align-self-center">
            @if($quizCollection->count() != 0)
                <div class="d-flex flex-row mb-3">
                    <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#quizModal{{request()->route('courseid')}}" data-bs-whatever="@fat">Create Quiz</button>
                </div>
                <table class="table table-hover table table-bordered" style="width: 100%;">
                    <tr>
                        <th scope="col" class="text-left">Quiz Title</th>
                        <th scope="col">Status </th>
                        <th scope="col" class="text-center">Actions</th>
                    <tbody>
                    @foreach($quizCollection as $quiz)
                        <tr>
                            <td width="75%" class="text-left p-3">
                                <a href="{{ route('student.viewQuiz', [request()->route('courseid'), $quiz->quiz_id])}}">{{ $quiz->quiz_title }}</a>
                                <br>
                                <p style="font-size:small;">Available on {{\Carbon\Carbon::parse($quiz->start_date)->isoFormat('MMMM DD YYYY')}} {{$quiz->start_time}} until {{\Carbon\Carbon::parse($quiz->end_date)->isoFormat('MMMM DD YYYY')}} {{$quiz->end_time}}</p>

                            </td>
                            <td class="text-center">
                                @if( $quiz->status == 'active')
                                <div class="badge bg-success text-wrap" style="width: 100%;">
                                {{ $quiz->status }} 
                                </div>
                                @else
                                    @if($quiz->status == 'active')
                                        <div class="badge bg-success text-wrap" style="width: 100%;">
                                        {{ $quiz->status }} 
                                        </div>
                                    @else
                                        <div class="badge bg text-wrap" style="width: 100%; background-color:grey;">
                                        {{ $quiz->status }} 
                                        </div>
                                    @endif
                                @endif
                                <br>
                                <div class="form-check form-switch toogleSwitch">
                                    <input class="form-check-input activate" value="{{$quiz->quiz_id}}"  type="checkbox" role="switch" id="flexSwitchCheckChecked"  @if($quiz->status == 'active') checked @endif>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('quiz.edit',[ request()->route('courseid') ,$quiz->quiz_id]) }}" title="Edit Quiz"><button class="btn btn-warning" style="background-color:lightgreen;border: 1px solid lightgreen;"><img src="{{ asset('images/edit.png') }}" alt="" ></button></a>
                                <a href="{{ route('quiz.delete', $quiz->quiz_id) }}" title="Delete Quiz" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger"><img src="{{ asset('images/delete.png') }}" alt="" ></button></a>
                                <a href="" title="View student attempts" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger" style="background-color: orange; border: 1px solid orange;"><img src="{{ asset('images/student.png') }}" alt="" ></button></a>
                                <a href="" title="View student attempts" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger" style="background-color: orange; border: 1px solid orange;"><img src="{{ asset('images/question.png') }}" alt="" ></button></a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="d-flex flex-row mb-3">
                    <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#quizModal{{request()->route('courseid')}}" data-bs-whatever="@fat">Create Quiz</button>
                </div>
                <h2>No created quizzes..</h2>
            @endif
            </div>
        </div>
    </div>  

    <script>
        const toastLiveExample = document.getElementById('liveToast')

        $(document).ready(function(){

            $(window).on('load', 
                // getAllQuizzes()
            );

            // function displayQuizStatus(){

            //     const toggleSwitch = document.getElementsByClassName("toogleSwitch");

            //     for(y=0;y<toggleSwitch.length;y++){

            //     }

            // }
            
            

            // function getAllQuizzes(){
            //     getAllQuizzesRoute = "{{route('quiz.all', request()->route('courseid'))}}";
            //     $.ajax({
            //         type: "get",
            //         url: getAllQuizzesRoute,
            //         dataType: "json",
            //         success: function (response) {
            //             console.log(response);
            //             displayAllQuizzes(response);
            //         }
            //     });
            // }
            // function displayAllQuizzes(data){
            //     for(quiz in data){
            //         console.log(data[quiz].quiz_title);
            //         table = `
            //                 <td width="80%" class="text-left p-3">
            //                     <a href="">${data[quiz].quiz_title}</a>
            //                     <br>
            //                     <p style="font-size:small;">Available on Sep 7, 2022 10:30 AM until Sep 7, 2022 12:30 PM</p>
            //                 </td>
            //                 <td>
            //                 `;
            //         if(data[quiz].status == 'active'){
            //             table +=`
            //                     <div class="badge bg-success text-wrap" style="width: 100%;">
            //                         ${data[quiz].status}
            //                     </div>`;
            //         }else{
            //             table +=`
            //                     <div class="badge bg-danger text-wrap" style="width: 100%;">
            //                         ${data[quiz].status} 
            //                     </div>
            //                 <br>
            //             `;
            //         }
            //         table+=` 
            //                     <br>
                                
            //                 </td>
            //                 <td>
            //                     <a href="/teacher/course/{{request()->route('courseid')}}/quiz/setup/${data[quiz].quiz_id}" title="Edit Quiz"><button class="btn btn-warning"><img src="{{ asset('images/edit.png') }}" alt="" ></button></a>
            //                     <a href="/quiz/delete/${data[quiz].quiz_id}" title="Delete Quiz" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger"><img src="{{ asset('images/delete.png') }}" alt="" ></button></a>

            //                 </td>
            //         `;
            //         $('#quizzes').html(table);
            //     }
            // }

            const toggle = document.getElementsByClassName("activate");
            
            for(x=0;x<toggle.length;x++){
                $(toggle[x]).change(function(e){
                    var quizId = this.value;
                    var activateQuizRoute = '/teacher/quiz/' + quizId + '/activate';
                    const toast = new bootstrap.Toast(toastLiveExample)
                    // var activateQuizRoute = "{{route('quiz.activate', ":quizid")}}";
                    // activateQuizRoute.replace(':quizid', $quizId);
                        e.preventDefault();
                        
                        console.log(activateQuizRoute);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            }
                        });
                        $.ajax({
                                url: activateQuizRoute,
                                type: 'post',
                                dataType: 'json',
                                success: function(response){
                                    if(response.status == 'active'){
                                        $(".toast-body").html('Quiz is now active.');
                                        toast.show();
                                    }
                                    else{
                                        $(".toast-body").html('Quiz is now inactive.');
                                        toast.show();
                                        // alert('Quiz is now inactive.');
                                    }
                                    // window.location.reload();
                                },
                                error: function(error){
                                    $(".toast-body").html('Error activating quiz. Please complete setting up the quiz first.');
                                    
                                    
                                    // alert('Error activating quiz. Please set quiz settings first.');
                                    toast.show();
                                    // window.location.reload();
                                    console.log(error);
                                }
                        });
                });
            }
        });
    </script>
    
@stop
