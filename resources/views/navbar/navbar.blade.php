<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> -->
    <script src= "{{ asset('js/bootstrap.js') }}" ></script>
    
    <title>Document</title>

    <style>
      .nav-link {
        color:orange;
      }
      a{
        text-decoration: none;
        color:orange;
      }
      nav{
        /* box-shadow: 2px 1px 5px 2px lightgrey; */
        /* border-bottom: 2px solid white; */
        background-color: white;
      }
      .navbar-brand{
        color:orange;
      }
      .container-fluid a{
        font-size: 20px;
      }
      #container-outer{
        width: 1500px;
      }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg" >
  <div class="container-fluid" id="container-outer">
  @auth
    @if(Auth::user()->userType == '0')
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('images/logo_white.png') }}" alt="" width="40" height="30" class="d-inline-block align-text-top">
        TURO
      </a>
    @else
      <a class="navbar-brand" href="">
        <img src="{{ asset('images/logo_white.png') }}" alt="" width="40" height="30" class="d-inline-block align-text-top">
        TURO
      </a>
      @endif
  @endauth
  @guest
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('images/logo_white.png') }}" alt="" width="40" height="30" class="d-inline-block align-text-top">
        TURO
      </a>
  @endguest
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav justify-content-center">
        <!-- <li class="nav-item">

          <a class="nav-link active" id="homeButton" aria-current="page">Home</a>
        </li> -->
        @auth
          @if(Auth::user()->userType == '2')
            <li class="nav-item">
            <a class="nav-link active" style="color: orange;" aria-current="page" href="{{route('student.home')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" style="color: orange;" aria-current="page" href="{{route('student.enrollment_page')}}">Enrollment</a>
            </li>
            
          @elseif(Auth::user()->userType == '1')
            <li class="nav-item">
              <a class="nav-link active" style="color: orange;" aria-current="page" href="{{route('course.all')}}">Dashboard</a>
            </li>
            
          @else
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('users.all')}}">Manage Users</a>
            </li>
          @endif
        @endauth
        @yield('left-side-nav')
      </ul>
      
      <span class="d-flex">
      @auth
      <ul class="navbar-nav">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          @if(Auth::user()->userType == '2')

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{Auth::user()->username}}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('student.profile')}}">Profile</a></li>
              <li><a class="dropdown-item" href="{{route('user.logout')}}">Logout</a></li>
            </ul>
          </li>
          
          @endif
          @if(Auth::user()->userType == '1')

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::user()->username}}
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('teacher.profile')}}">Profile</a></li>
                <li><a class="dropdown-item" href="{{route('user.logout')}}">Logout</a></li>
              </ul>
            </li>
            <li><a class="dropdown-item" href="{{route('user.logout')}}">Logout</a></li>
          @endif
        </div>
      </ul>
      @endauth
      @guest
      
      @if(Route::currentRouteName() == 's-login')
        <a class="nav-link" style="color: orange;" href="{{route('student.registration')}}">Register</a>
      @elseif(Route::currentRouteName() == 'student.registration')
        <a class="nav-link" style="color: orange;" href="{{route('s-login')}}">Login</a>
      @elseif(Route::currentRouteName() == 'home')
        <a class="nav-link" style="color: orange;" href="{{route('s-login')}}">Login</a>

      @elseif(Route::currentRouteName() == 'teacher.registration')
        <a class="nav-link" style="color: orange;" href="{{route('t-login')}}">Login</a>
      @elseif(Route::currentRouteName() == 't-login')
        <a class="nav-link" style="color: orange;" href="{{route('teacher.registration')}}">Register</a>
      @endif
        
      @endguest
        @yield('right-side-nav')
      
      </span>
    </div>
  </div>
</nav>
</body>
<script>
    let confirmTask = document.getElementById('homeButton');
        confirmTask.addEventListener('click',()=>{
            if(Auth::user()->userType == '1'){
              window.location.href = "{{ route('teacher.home') }}";
            }
            else{
              window.location.href = "{{ route('home') }}";
            }
        }); 
</script>
</html>