@extends('main')

@section('right-side-nav')
     <a class="nav-link" style="color: white;" href="{{route('s-login')}}">Login</a>
@stop

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
@stop  

@section('script-area')

    function showInput(answer){
        console.log(answer.value);
        if(answer.value === 'yes'){
            document.getElementById('survery-form').classList.remove('d-none');
        }
        elseif(answer.value === 'no'){
            document.getElementById('survery-form).classList.add('d-none');
        }
    }

@stop

@section('guest-content')
    <section id="registration-form">
        <br>
        <h2>Student Registration</h2>
        
        <br>
        <form action="{{ route('student.register') }}" method="post">
            {{ csrf_field() }}
            <!-- For login details -->

            <label for=""><b>User / Login Information (Part 1)</b></label>
            <hr>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                        <input type="text" name="email"  class="form-control" id="inputEmail3">
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputUsername3" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-4">
                        <input type="text" name="username"  class="form-control" id="inputUsername3">
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-4">
                        <input type="password" name="password"  class="form-control" id="inputPassword3">
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>

            <hr>
            <label for=""><b>Personal Information (Part 1)</b></label>
            <hr>
            <input type="text" name="userType"  class="form-control" id="inputEmail3" value="0" hidden>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-2 col-form-label">LRN (if available): </label>
                <input type="text" name="LRN" class="form-control" placeholder="LRN (if available)" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <!-- Full name -->
            <label for="basic-url" class="form-label">Full name:</label>
            <div class="input-group mb-3">
            <input type="text" class="form-control" name="student_fname" placeholder="Last Name" aria-label="Username">
            <span class="input-group-text"> </span>
            <input type="text" class="form-control" name="student_mname" placeholder="First Name (Optional)" aria-label="Server">
            <span class="input-group-text"> </span>
            <input type="text" class="form-control" name="student_lname" placeholder="Middle Name (Optional)" aria-label="Server">
            </div>
            <!-- end of full name -->

            <!-- Date of birth -->
            <div class="row mb-3">
                <label for="student_birth" class="col-sm-2 col-form-label">Date of Birth:</label>
                <div class="col-sm-2">
                    <input type="date" name="student_birth"  class="form-control" id="inputUsername3">
                </div>
            </div>
            <!-- end of DOB -->

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

            
            
            <!-- Gender -->
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Gender:</label>
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="student_gender" id="exampleRadios1" value="M" checked>
                    <label class="form-check-label" for="gender">
                        Male
                    </label>
                    
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="student_gender" id="exampleRadios2" value="F">
                    <label class="form-check-label" for="gender">
                        Female
                    </label>
                </div>
                
            </div>
            <!-- end of gender -->
            <!-- Civil status -->
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Civil status:</label>
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="student_civil" id="exampleRadios1" value="M" checked>
                    <label class="form-check-label" for="status">
                        Single
                    </label>
                    
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="student_civil" id="exampleRadios2" value="F">
                    <label class="form-check-label" for="status">
                        Married
                    </label>
                </div>
                
            </div>

            <!-- end of civil status -->

            <!-- Full name -->
            <label for="basic-url" class="form-label">Mother's Maiden Name:</label>
            <div class="input-group mb-3">
            <input type="text" class="form-control" name="student_motherlname" placeholder="Last Name" aria-label="Username">
            <span class="input-group-text"> </span>
            <input type="text" class="form-control" name="student_motherfname" placeholder="First Name (Optional)" aria-label="Server">
            <span class="input-group-text"> </span>
            <input type="text" class="form-control" name="student_mothermname" placeholder="Middle Name (Optional)" aria-label="Server">
            </div>
            <!-- end of full name -->


            
           
            <br>
            <label for="">Educational Information (Part 2)</label>
            <hr>
            
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Last grade level completed:</label>
                <br>
                <select class="form-select" name="last_level" style="width: 200px;">
                    <option value="none" selected>Kinder</option>
                    <option value="G1">G-1</option>
                    <option value="G2">G-2</option>
                    <option value="G3">G-3</option>
                    <option value="G4">G-4</option>
                    <option value="G5">G-5</option>
                    <option value="G6">G-6</option>
                    <option value="G7">G-7</option>
                    <option value="G8">G-8</option>
                    <option value="G9">G-9</option>
                    <option value="G10">G-10</option>
                </select>
                
            </div>

            <div class="">
                <p>Have you attended ALS learning sessions before?</p>
                <select class="form-select" id="specificSizeSelect" name="answer_type" onchange="showInput(this)" style="width: 200px;">
                    <option selected>Choose answer</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div id="survery-form" >
                <label for="basic-url" class="form-label">If yes, </label>
                <div style="display: flex; height:50px;">
                    <label for="program_attended" name="program_attended" class="col-sm-2 col-form-label">Name of the program: </label>
                    <input type="text" style="width:300px;margin-right: 20px;" class="form-control" placeholder="Name of program" aria-label="Username" aria-describedby="basic-addon1">
                    
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
            <label for=""><b>Necessary files to be submitted (Part 3)</b></label>
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
            
            <br>
            <div class="d-grid gap-1 col-2 mx-auto">
                <button type="submit" class="btn btn-primary" type="button">Submit</button>
            </div>
            <br>
            
        </form>
    </section>
@stop

