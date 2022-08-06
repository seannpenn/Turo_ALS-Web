@extends('main')

@section('css-style')
    
        #registration-form {
            margin: 0 auto;
            width: 1000px;
            height: 300px;
            border: 1 solid;
        }
        h2{
            text-align:center;
        }
        button{
            text-align:center;
        }
        label {
            display: inline-block;
            width: 400px;
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
        #application-form{
            width:100%;
        }
@stop  

@section('main-content')
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
                @if($studentPersonal['LRN'] != null)
                    <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentPersonal['LRN']}}</label>
                
                @else
                    <form action="{{route('student.provideLRN', $studentPersonal['studentId'])}}" method="post" class="row g-3">
                        {{ csrf_field() }}
                        <div class="col-auto">
                            <input type="text" class="form-control" name="LRN" id="staticEmail2" value="">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-1">Provide LRN</button>
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
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentPersonal['student_lname']}}, {{$studentPersonal['student_fname']}} {{$studentPersonal['student_mname']}}  </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Gender: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentPersonal['student_gender']}}</label>
            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Civil status: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentPersonal['student_civil']}} </label>
            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Date of Birth: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentPersonal['student_birth']}} </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Address: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentInfo['street']}}, {{$studentInfo['barangay']}}, {{$studentInfo['city']}}, {{$studentInfo['province']}} </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Mother's Maiden Name </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentInfo['student_motherfname']}} {{$studentInfo['student_motherfname']}} {{$studentInfo['student_motherlname']}}</label>

            </div>
            
           
            <br>
            <label for="">Educational Information (Part 2)</label>
            <hr>
            
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Last Grade Level Completed </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentBack['last_level']}} </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Attended ALS sessions before? </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>
            </div>
            <label for="basic-url" class="form-label">If yes, </label>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Name of Program </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentBack['program_attended']}} </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Level of literacy </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentBack['program_literacy']}} </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Year attended </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentBack['program_attended_year']}} </label>

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
            <form action="{{route('student.approve', $studentPersonal['studentId'])}}" method="post">
                <div class="d-grid gap-1 col-3 mx-auto">
                    {{ csrf_field() }}
                    @if($studentPersonal['status'] == 'pending')
                        <button type="submit" class="btn btn-primary" type="button">Approve enrollment</button>
                    @else
                        <button type="submit" class="btn btn-primary" type="button" disabled>Enrolled</button>
                    @endif
                </div>
            </form>
            <br>
    </section>
@stop