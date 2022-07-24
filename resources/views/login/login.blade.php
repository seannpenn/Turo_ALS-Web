@extends('main')

@section('right-side-nav')
     <a class="nav-link" style="color: white;" href="{{route('register')}}">Register</a>
@stop

@section('css-style')
    
        #login-form {
            margin: 0 auto;
            width: 500px;
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
<section id="login-form">
        <br>
        <h2>Teacher Login</h2>
        <br>
        <form action="{{ route('user.login') }}" method="post">
        {{ csrf_field() }}
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" value="{{ old('email') }}" class="form-control" id="inputEmail3">
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
           
            
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-primary" type="button">Sign in</button>
            </div>
            
        </form>
    </section>
@stop


    
