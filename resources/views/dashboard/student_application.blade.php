@extends('main')

@section('css-style')
    
        #application-form {
            margin: 0 auto;
            margin-top: 20px;
            margin-bottom: 20px;
            
            width:60%;
            padding: 30px;
            box-shadow: 0px 10px 20px grey;
        }
        h2{
            text-align:center;
        }
        button{
            text-align:center;
        }
        
        
        select {
            width: 200px;
            text-overflow: ellipsis;
            margin-bottom: 10px;
        }
        span{
            color: #f00;
            font-weight: bold;
        }
        #action-button{
            text-align:center;
            position:fixed;
            bottom:40px;
            right:36%;
        }
@stop  

@section('main-content')
@include('navbar/navbar_inside')
    <section id="application-form">
        <br>
        <h2>Student Application</h2>
        
        <br>
        
            <!-- For login details -->
            <label for=""><b>Personal Information (Part 1)</b></label>
            <hr>
            
            
            <input type="text" name="userType"  class="form-control" id="inputEmail3" value="0" hidden>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">LRN (if available): </label>
                @if($studentApplication->LRN!= null)
                    <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->LRN}}</label>
                
                @else
                    <form action="{{route('student.provideLRN', $studentApplication->studentId)}}" method="post" class="row g-3">
                        {{ csrf_field() }}
                        <div class="col-auto">
                            <input type="text" class="form-control" name="LRN" id="staticEmail2" value="">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-warning mb-1">Provide LRN</button>
                        </div>
                        <div class="col-auto">
                            @foreach($errors->get('LRN') as $errorMessage )
                                <span>{{ $errorMessage }}</span>
                            @endforeach

                            @if (session('error'))
                                <span>{{ session('error') }}</span>
                            @endif
                        </div>
                        
                    </form>
                
                @endif
            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Full name: </label>
                <label for="student_LRN" class="col-sm-3 col-form-label">{{$studentApplication->student_lname}}, {{$studentApplication->student_fname}} {{$studentApplication->student_mname}}  </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Gender: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->student_gender}}</label>
            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Civil status: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->student_civil}} </label>
            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Date of Birth: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->student_birth}} </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Place of Birth: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->student_placeofbirth}} </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Address: </label>
                <label for="student_LRN" class="col-sm-4 col-form-label">{{$studentApplication->street}}, {{$studentApplication->barangay}}, {{$studentApplication->city}}, {{$studentApplication->province}} </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Mother's Maiden Name </label>
                <label for="student_LRN" class="col-sm-4 col-form-label">{{$studentApplication->family->student_motherfname}} {{$studentApplication->family->student_motherfname}} {{$studentApplication->family->student_motherlname}}</label>

            </div>
            
           
            <br>
            <label for="">Educational Information (Part 2)</label>
            <hr>
            
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Last Grade Level Completed </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->education->last_level}} </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Attended ALS sessions before? </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->education->answer_type}} </label>
            </div>
            <label for="basic-url" class="form-label">If yes, </label>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Name of Program </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->education->program_attended}} </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Level of literacy </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->education->program_literacy}} </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Year attended </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentApplication->education->program_attended_year}} </label>

            </div>

            <br>
            <label for=""><b>Files submitted (Part 3)</b></label>
            <hr>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">PSa </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">2x2 picture </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Form 138 </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>


            <br>
            
            
            <br>
            <form action="{{route('student.approve', $studentApplication->studentId)}}" method="post">
                <div class="d-grid gap-1 col-3 mx-auto" id="action-button">
                    {{ csrf_field() }}
                    @if($studentApplication->status == 'pending')
                        <button type="submit" class="btn btn-warning" type="button" onclick="return confirm('are you sure?')">Approve enrollment</button>
                    @else
                        <button type="submit" class="btn btn-warning" type="button" disabled>Enrolled</button>
                    @endif
                </div>
            </form>
            <br>
    </section>
@stop