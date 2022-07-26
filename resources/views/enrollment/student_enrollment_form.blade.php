@extends('main')

@section('css-style')
    #registration-form {
        margin: 0 auto;
        margin-top: 20px;
        margin-bottom: 20px;
        text-align: left;
        width:1000px;
        padding: 30px;

        border: 1 solid;
        box-shadow: 0px 10px 20px grey;
    }
    select {
        width: 200px;
        text-overflow: ellipsis;
        margin-bottom: 10px;
    }
    #radio-label{
        margin-right: 50px;
    }
    .form-check-label{
        margin-right: 50px;
    }
    .feedback{
        margin: 0 auto;
    }
@stop

@section('main-content')

    <section id="registration-form">

    @if(Auth::user()->student->enrollment == null)
        <br>
        <h2>Student Enrollment</h2>
        
        <br>
        <form action="{{ route('student.enroll') }}" method="post">
            {{ csrf_field() }}
    
            <label for=""><b>Personal Information (Part 1)</b></label>
            <div class="mb-3">

            <label for="recipient-name" class="col-form-label">Program applying for:</label>
            <select class="form-select" name="prog_id" style="width: 400px; height: 40px;">
              @foreach($programs as $program)
                <option value="{{ $program['prog_id'] }}" selected>{{ $program['prog_fname'] }}</option>
              @endforeach
            </select>
            <br>
          </div>
            <hr>
            <input type="text" name="userType"  class="form-control" id="inputEmail3" value="0" hidden>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-2 col-form-label">LRN (if available): </label>
                <input type="text" name="LRN" class="form-control" placeholder="LRN (if available)" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <!-- Full name -->
            <label for="basic-url" class="form-label">Full name:</label>
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Last Name" aria-label="Username" value="{{$student->student_fname}}" readonly>
            <input type="text" class="form-control" placeholder="First Name (Optional)" aria-label="Server" value="{{$student->student_mname}}" readonly>
            <input type="text" class="form-control" placeholder="Middle Name (Optional)" aria-label="Server" value="{{$student->student_lname}}" readonly>
            </div>
            <!-- end of full name -->

            <!-- Address -->
            <label for="basic-url" class="form-label">Address:</label>
            <div class="input-group mb-3">
                <input type="text" name="street" class="form-control" placeholder="House No./Street/Sitio" id="basic-url" aria-describedby="basic-addon3">
                <input type="text" name="barangay" class="form-control" placeholder="Barangay" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
                <input type="text" name="city" class="form-control" placeholder="Municipality / City" id="basic-url" aria-describedby="basic-addon3">
                <input type="text" name="province" class="form-control" placeholder="Province" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <!-- end of address -->

            <!-- Date of birth -->
            <div class="row mb-3">
                <label for="student_birth" class="col-sm-2 col-form-label">Date of Birth:</label>
                <div class="col-sm-2">
                    <input type="date" name="student_birth"  class="form-control" id="inputUsername3">
                </div>
            </div>
            <!-- end of DOB -->

            <!-- Place of birth -->
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Place of birth (Municipality/City):</label>
                <div class="col-sm-3">
                    <input type="text" name="student_placeofbirth"  class="form-control" id="inputPassword3">
                </div>
            </div>
            <!-- end of POB -->
            
            <!-- Gender -->
            
            <div class="input-group mb-3">
                <label for="recipient-name" style="margin-right: 50px;">Gender:</label>
                <br>
                <div class="form-check">
                    
                    <input class="form-check-input" type="radio" name="student_gender" id="radio-button" value="M" checked>
                    <label class="form-check-label" id="radio-label" for="gender">
                        Male
                    </label>

                    <input class="form-check-input" type="radio" name="student_gender" id="radio-button" value="F">
                    <label class="form-check-label" id="radio-label" for="gender">
                        Female
                    </label>
                    
                </div>
                
            </div>
            <!-- end of gender -->

            <!-- Civil status -->

            <div class="input-group mb-3">
                <label for="recipient-name" style="margin-right: 50px;">Civil status:</label>
                <br>
                <div class="form-check">
                    
                    <input class="form-check-input" type="radio" name="student_civil" id="exampleRadios1" value="Single" checked>
                    <label class="form-check-label" for="status">
                        Single
                    </label>

                    <input class="form-check-input" type="radio" name="student_civil" id="exampleRadios2" value="Married">
                    <label class="form-check-label" for="status">
                        Married
                    </label>

                    <input class="form-check-input" type="radio" name="student_civil" id="exampleRadios2" value="Separated">
                    <label class="form-check-label" for="status">
                        Separated
                    </label>

                    <input class="form-check-input" type="radio" name="student_civil" id="exampleRadios2" value="Widow">
                    <label class="form-check-label" for="status">
                        Widow
                    </label>

                    <input class="form-check-input" type="radio" name="student_civil" id="exampleRadios2" value="Parent">
                    <label class="form-check-label" for="status">
                        Solo Parent
                    </label>
                    
                </div>
                
            </div>
            <!-- end of civil status -->

            <!-- Religion -->
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Religion:</label>
                <div class="col-sm-3">
                    <input type="text" name="student_religion"  class="form-control" id="inputPassword3">
                </div>
            </div>
            <!-- end of religion -->

            <!-- Contact number -->
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Contact Number:</label>
                <div class="col-sm-3">
                    <input type="text" name="student_contactnumber"  class="form-control" id="inputPassword3">
                </div>
            </div>
            <!-- end of CN-->

            <br>
            <hr>
            <label for=""><b>Student Family background (Part 2)</b></label>
            <hr>

            <!-- Father's Full name -->
            <label for="basic-url" class="form-label">Name of Father/Legal Guardian:</label>
            <div class="input-group mb-3">
            <input type="text" class="form-control" name="student_complname" placeholder="Last Name" aria-label="Username">
            <input type="text" class="form-control" name="student_compfname" placeholder="First Name " aria-label="Server">
            <input type="text" class="form-control" name="student_compmname" placeholder="Middle Name (Optional)" aria-label="Server">
            </div>
            <!-- end of full name -->

            

            <!-- Mother's Maiden name -->
            <label for="basic-url" class="form-label">Mother's Maiden Name:</label>
            <div class="input-group mb-3">
            <input type="text" class="form-control" name="student_motherlname" placeholder="Last Name" aria-label="Username">
            <input type="text" class="form-control" name="student_motherfname" placeholder="First Name " aria-label="Server">
            <input type="text" class="form-control" name="student_mothermname" placeholder="Middle Name (Optional)" aria-label="Server">
            </div>
            <!-- end of full name -->

             


            
           
            <br>
            <hr>
            <label for=""><b>Educational Information (Part 3)</b></label>
            <hr>
            
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Last grade level completed:</label>
                <br>
                <select class="form-select" name="last_level" style="width: 200px;">
                    <option value="none" selected>Kinder</option>
                    <option value="G1">Grade 1</option>
                    <option value="G2">Grade 2</option>
                    <option value="G3">Grade 3</option>
                    <option value="G4">Grade 4</option>
                    <option value="G5">Grade 5</option>
                    <option value="G6">Grade 6</option>
                    <option value="G7">Grade 7</option>
                    <option value="G8">Grade 8</option>
                    <option value="G9">Grade 9</option>
                    <option value="G10">Grade 10</option>
                    <option value="G11">Grade 11</option>
                </select>
                
            </div>

            <label for="basic-url" class="form-label">Why did you not attend/complete schooling?</label>
            <div class="col-sm-5">
                <input type="text" name="student_reason"  class="form-control" id="inputPassword3">
                <br>
            </div>


            <div class="">
                <p>Have you attended ALS learning sessions before?</p>
                <select class="form-select" id="select-survey" name="answer_type" style="width: 200px;">
                    <option selected>Choose answer</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>

            <div id="survey-form">
                <label for="basic-url" class="form-label">If yes, </label>

                <div class="row mb-3">
                    <label for="program_attended" class="col-sm-3 col-form-label">Name of the program:</label>
                    <div class="col-sm-3">
                        <input type="text" name="program_attended"  class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="row mb-3">
                    
                    <label for="student_LRN" class="col-sm-2 col-form-label">Level of Literacy: </label>
                    <br>
                    <select class="form-select" name="program_literacy" style="width: 200px; height: 40px;">
                        <option value="none" selected>Basic</option>
                        <option value="male">Elementary</option>
                        <option value="male">Secondary</option>
                        <option value="male">InfEd</option>
                    </select>


                    <label for="student_LRN" class="col-sm-2 col-form-label">Year attended: </label>
                    <input type="text" name="program_attended_year" style="width:200px;" class="form-control" placeholder="Name of program" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>

            <br>
            <hr>
            <label for=""><b>Necessary files to be submitted (Part 4)</b></label>
            <hr>


            <br>
            <div class="mb-3">
                <label for="formFile" class="form-label">PSA / NSO Birth Certificate</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">2x2 ID picture (white background)</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label" style="width: 500px;">Form 137 (only for learners from the formal education system)</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="d-grid gap-1 col-2 mx-auto">
                <button type="submit" class="btn btn-warning" type="button">Enroll</button>
            </div>
        </form>
    @else
        <h2>Enrollment submitted</h2>
        <p>View your Enrollment status <a href="{{route('student.enrollment_page')}}" style="color:#FF8E01">here.</a></p>
    @endif
    
</section>

@stop