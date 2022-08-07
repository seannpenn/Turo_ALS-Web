@extends('main')


@section('right-side-nav')
     <a class="nav-link" style="color: black;" href="{{ route('s-login') }}">Login</a>
@stop

@section('css-style')
        .main-content {
            width:100%;
            <!-- height: calc(100% - 56px); -->
            display: flex;
            flex-direction: column;
        }
        .header{
            text-align:center;
        }
        .center{
            margin-top: 40px;
            
            text-align:center;
        }
        .enroll{
            height: 100px;
            width: 400px;
            background-color:white;
            border-radius: 15px;
            border: 4px solid orange;
        }
        .enroll a{
            font-size: 35px;
            text-decoration:none;
            color:orange;
        }
        .banner-image {
            height: 720px;
            background-image: url("images/home_cover.jpg");
            background-size: cover;
            background-attachment: fixed;
        }
        .header h1{
            font-family: 'Montserrat';
            font-size: 7em;
        }
        .header h2{
            color:white;
           font-size: 10em;
        }
        .header p{
            font-family: 'Montserrat';
            letter-spacing: 5px;
            font-size: 2em;
        }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            line-height: 28px;
        }
        .section {
            max-width: 900px;
            padding: 0 24px;
            margin: 150px auto;
            align-content: center;
            text-align: justify;
        }
        .section h2 {
            margin-bottom: 42px;
            font-size: 32px;
            line-height: 42px;
            text-align: center;
            color: #4b5563;
        }
@stop 

@section('guest-content')
    
        <div class="main-content">
            <div class="banner-image">
                <br><br><br><br>
                <div class="header">
                    <h1>Welcome to </h1>
                    <h2>TURO</h2>
                    <p>In collaboration with DepEd</p>
                    <br>
                    <button type="submit" id="contentCreate" class="enroll"><a href="{{route('student.registration')}}"><b>Enroll now for free!</b></a></button>
                    <h6>Already enrolled? <a href="{{route('s-login')}}">Login </a>here</h6>
                </div>

            </div>

            <section id="about" class="section about-section">

                <h2>About ALS 2.0</h2>
                <p>
                    The Alternative Learning System (ALS) is a parallel learning system in the Philippines that provides opportunities
                    for out-of-school youth and adult (OSYA) learners to develop basic and functional literacy skills, and to access
                    equivalent pathways to complete basic education.
                </p>

                <p>
                    A viable alternative to the existing formal education system, ALS encompasses both non-formal and informal sources of 
                    knowledge and skills. As a second chance education program, it aims to empower OSYA learners to continue learning in a
                    manner, time and place suitable to their preference and circumstances, and for them to achieve their goals of improving
                    their quality of life and becoming productive contributors to society.
                </p>

                <p>
                    In 2016, the ALS Program began undergoing reforms as part of strengthening, intensifying, and expanding its implementation. 
                    Three years of consultation, review and development of policies, training, and evaluation with partners in the government, 
                    local and international non-government agencies, and civil society organizations led to the finalization of the enhanced ALS 
                    K to 12 Basic Education Curriculum, the development of the ALS Program 2.0, and the rollout of the five-year ALS 2.0 Strategic 
                    Roadmap.
                </p>
                

            </section>
            

            
            
            <div class="center">
                <br>
                <br>
                
            </div>
        </div> 
@stop
    
    

