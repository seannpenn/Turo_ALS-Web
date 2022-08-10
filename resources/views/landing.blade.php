@extends('main')

@section('css-style')
        .main-content {
            width:100%;
            <!-- height: calc(100% - 56px); -->
            display: flex;
            flex-direction: column;
        }
        
        .center{
            margin-top: 40px;
            
            text-align:center;
        }
        .enroll{
            height: 50px;
            width: 250px;
            background-color:white;
            border-radius: 30px;
            border: 1px solid white;
            justify-content:center;
            text-align:center;
        }
        .enroll a{
            font-size: 20px;
            text-decoration:none;
            color:orange;
        }
        .banner-image {
            height: 1000px;
            width: 100%;
            background-image: url("images/background.png");
            <!-- background-color: #FF8E01; -->
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            justify-content:center;
            display:flex;
        }
        .header{
            margin-top: 150px;
            width: 1100px;
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
        .logo{
            display:flex;
            width: 400px;
            justify-content:space-evenly;
        }
        .icons{
            margin-top: 150px;
            width:150px;
            height: 130px;
        }
        .lower{
            position:absolute;
            bottom: 0;
        }
        .site-footer {
            padding: 42px 24px;
            text-align: center;
            /* background-color: #f9fafb; */
            background-color: #eceff1dc;
        }

        .site-footer p {
            margin: 0;
            color: #4b5563;
        }
@stop 

@section('main-content')

    
        <div class="main-content">
            <div class="banner-image">
                <br><br><br><br>
                
                <div class="header">
                    <!-- <h1>Welcome to </h1> -->
                    <h2>TURO</h2>
                    <p style="font-size: 30px;">A seamless access for your <b style="color:white;">ALS</b> learning materials</p>
                    <p>In collaboration with DepEd</p>
                    <br>
                        @auth
                            <button type="submit" id="contentCreate" class="enroll"><a href="{{route('student.enrollment_page')}}"><b>Enroll now for free!</b></a></button>
                        @endauth
                        @guest
                            <button type="submit" id="contentCreate" class="enroll"><a href="{{route('s-login')}}"><b>Enroll now for free!</b></a></button>
                        @endguest
                </div>
                
                <div class="logo">
                    <img class="icons"src="{{ asset('images/deped_logo.png') }}" alt="">
                    <img class="icons"src="{{ asset('images/als.png') }}" alt="">
                </div>
                
                <div class="lower">
                    <h2>Worry less and learn more</h2>
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
                <br>
                <!-- <h2><b>ALS Programs offered</b></h2>
                
                <h3><b>BASIC LITERACY PROGRAM</b></h3>
                <p>
                    The Basic Literacy Program (BLP) is a program component of ALS aimed at eradicating
                    illiteracy among OSYA, and in extreme cases, school-aged children, 
                    by developing the basic literacy skills of reading, writing, and numeracy.
                </p>

                <br>

                <h3><b>ACCREDICATION AND EQUIVALENCY PROGRAM</b></h3>
                <p>
                    The Accreditation and Equivalency (A&E) Program is a program component of ALS aimed 
                    at providing an alternative pathway of learning for OSYA who have the basic literacy 
                    skills but have not completed the K to 12 basic education mandated by the Philippine 
                    Constitution. Through this program, school dropouts are able to complete elementary 
                    and high school education outside the formal school system.
                </p>

                <h3><b>LIFE SKILLS FOR WORK READINESS AND CIVIC ENGAGEMENT PROGRAM</b></h3>
                <p>
                Consistent with the goal to intensify its second chance education program and make it more 
                responsive to the needs of the learners, DepEd integrated the Life Skills for Work Readiness 
                and Civic Engagement Program developed under the Mindanao Youth Development project of USAID.
                The Life Skills for Work Readiness and Civic Engagement Program aimed to address the mismatch 
                between skills taught in school and skills demanded in the workplace that have left young people 
                unable to find jobs, start their own businesses, or otherwise contribute to their communities.
                </p>

                <h3><b>INFORMAL EDUCATION FOR DISADVANTAGED CHILDREN</b></h3>
                <p>
                This program focuses on packaging of short-term educational activity that addresses the 
                special needs and interests of the street and working children. It intends to use life skills 
                active learning approaches/strategies aimed at developing/enhancing social, civic, aesthetic, 
                cultural, recreational physical and personal development. The learning materials/packages may be 
                developed/adopted/adapted or gathered from other sources and tailored-fit to the identified needs 
                of the said users.
                </p>

                <h3><b>PARENT EDUCATION</b></h3>
                <p>
                The Parent Education is an informal education which is a life skills short-term course that addresses
                the special needs and interests of the parents to promote pride in their work and ownership of their 
                responsibilities as members of the family and their community.
                </p> -->

            </section>
            
            
            
            
            
            <footer class="site-footer">
                <p>Turo Development</p>
            </footer>
        </div> 
@stop
    
    

