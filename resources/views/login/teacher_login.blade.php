@extends('main')

@section('css-style')
        .banner-image{
            height: 400px;
            width: 100%;
            background-image: url("images/t-login.png");
            background-color: #FF8E01;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            justify-content:center;
            display:flex;
        }
        #login-form {
            position: absolute;
            margin: 0 auto;
            margin-top: 200px;
            background-color:white;
            border-radius: 20px;
            height: 400px;
            padding: 50px;
            width: 500px;
            border: 1 solid;
            box-shadow: 0px 5px 10px grey;
        }
        h2{
            text-align:center;
        }
        button{
            text-align:center;
            background-color: #FF8E01;
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
        .logo{
            display:flex;
            width: 400px;
            justify-content:space-evenly;
        }
        .icons{
            margin-top: 30px;
            width:150px;
            height: 130px;
        }
@stop  

@section('guest-content')
<div class="banner-image">
    <div class="logo">
        <img class="icons"src="{{ asset('images/deped_logo.png') }}" alt="">
        <img class="icons"src="{{ asset('images/als.png') }}" alt="">
    </div>
    <section id="login-form">
        <br>
        <h2>Teacher Login</h2>
        <br>
        
        <form action="{{ route('teacher.login') }}" method="post">
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
                <button type="submit" class="btn btn-warning" type="button">Sign in</button>
            </div>
        </form>
        
    </section>
    </div>

@stop


    
