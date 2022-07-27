@extends('main')

@section('right-side-nav')
     <a class="nav-link" style="color: white;" href="{{route('s-login')}}">Login</a>
@stop

@section('css-style')
    
        #registration-form {
            margin: 0 auto;
            width: 800px;
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
            width: 200px;
        }
        input {
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        select {
            width: 200px;
            text-overflow: ellipsis;
            margin-bottom: 10px;
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

            <input type="text" name="userType"  class="form-control" id="inputEmail3" value="0" hidden>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email"  class="form-control" id="inputEmail3">
                    <div class="col-auto">
                        @foreach($errors->get('email') as $errorMessage )
                            <span>{{ $errorMessage }}</span>
                        @endforeach 
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputUsername3" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username"  class="form-control" id="inputUsername3">
                    <div class="col-auto">
                        @foreach($errors->get('email') as $errorMessage )
                            <span>{{ $errorMessage }}</span>
                        @endforeach 
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password"  class="form-control" id="inputPassword3">
                    <div class="col-auto">
                        @foreach($errors->get('password') as $errorMessage )
                            <span>{{ $errorMessage }}</span>
                        @endforeach 
                    </div>
                </div>
            </div>
           
            <!-- for user details -->

            <div class="row mb-3">
                <label for="teacher_fname" class="col-sm-2 col-form-label">First Name:</label>
                <div class="col-sm-10">
                    <input type="text" name="student_fname"  class="form-control" id="inputUsername3">
                </div>
            </div>

            <div class="row mb-3">
                <label for="teacher_mname" class="col-sm-2 col-form-label">Middle Name (Optional):</label>
                <div class="col-sm-10">
                    <input type="text" name="student_mname"  class="form-control" id="inputUsername3">
                </div>
            </div>

            <div class="row mb-3">
                <label for="teacher_lname" class="col-sm-2 col-form-label">Last Name:</label>
                <div class="col-sm-10">
                    <input type="text" name="student_lname"  class="form-control" id="inputUsername3">
                </div>
            </div>

            <div class="row mb-3">
                <label for="teacher_number" class="col-sm-2 col-form-label">Phone number:</label>
                <div class="col-sm-10">
                    <input type="tel" name="student_number"  class="form-control" id="teacher_number" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="teacher_birth" class="col-sm-2 col-form-label">Date of Birth:</label>
                <div class="col-sm-10">
                    <input type="date" name="student_birth"  class="form-control" id="inputUsername3">
                </div>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-primary" type="button">Submit</button>
            </div>
            
        </form>
    </section>
@stop