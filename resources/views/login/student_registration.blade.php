@extends('main')

@section('right-side-nav')
     <a class="nav-link" style="color: white;" href="{{route('s-login')}}">Login</a>
@stop

@section('css-style')
    
        #registration-form {
            margin: 0 auto;
            margin-top: 20px;
            margin-bottom: 20px;
            
            width:600px;
            padding: 30px;

            border: 1 solid;
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
         #radio-label{
            margin-right: 50px;
        }
        .form-check-label{
            margin-right: 50px;
        }
@stop  



@section('guest-content')

    <section id="registration-form">
        <br>
        <h2>Student Account Registration</h2>
        
        <br>
        <form action="{{ route('student.register') }}" method="post">
            {{ csrf_field() }}
            <!-- For login details -->
            <hr>
                <input type="text" name="userType"  class="form-control" id="inputEmail3" value="0" hidden>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-8">
                        <input type="text" name="email"  class="form-control" id="inputEmail3">
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputUsername3" class="col-sm-3 col-form-label">Username:</label>
                    <div class="col-sm-8">
                        <input type="text" name="username"  class="form-control" id="inputUsername3">
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Password:</label>
                    <div class="col-sm-8">
                        <input type="password" name="password"  class="form-control" id="inputPassword3">
                        <div class="col-auto">
                            
                        </div>
                    </div>
                </div>

            <br>
            <hr>
            
            <br>
            <div class="d-grid gap-1 col-2 mx-auto">
                <button type="submit" class="btn btn-warning" type="button">Register</button>
            </div>
            <br>
            
        </form>
    </section>
@stop

@section('script-area')

    var x = document.getElementById("select-survey").value;
        console.log(x);
        if(x == "1")
            document.getElementById('survey-form').classList.remove('d-none');
        else
            document.getElementById('survery-form).classList.add('d-none');
@stop

