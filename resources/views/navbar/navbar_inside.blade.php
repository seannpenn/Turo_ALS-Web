<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src= "{{ asset('js/bootstrap.js') }}" ></script>
    <title>Document</title>
    <script>
      
    </script>
    <style>
      .inner-nav-link{
        
        font-size: 18px;
        color:orange;
        line-height: 40px;
        text-decoration:none;
        font-weight: bold;
        margin-left: 20px;
        margin-right: 20px;

      }
      .inner-nav-link:hover {
        
          text-decoration:none;
          color:white;
          text-shadow: 2px 2px orange;
      }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: white; border-bottom:1px solid orange; ">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">Create Course</a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText" >
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: 100%; text-align: center; justify-content:center; justify-items:center;">
      @auth
          @if(Auth::user()->userType == '1')
            @if(Route::currentRouteName() == 'course.all' || Route::currentRouteName() == 'students.all')

              <a class="inner-nav-link" aria-current="page" href="{{route('course.all')}}">Courses</a>
              <a class="inner-nav-link" aria-current="page" href="{{route('students.all')}}">Manage Enrollees</a>
            
            @elseif(Route::currentRouteName() != 'course.all')
              <a class="inner-nav-link" aria-current="page" href="{{route('course.all')}}">Courses</a>
              <a class="inner-nav-link" aria-current="page" href="{{route('course.showInfo', request()->route('id') )}}">Course Home</a>
              <a class="inner-nav-link" aria-current="page" href="{{route('course.displayAll', $courseId)}}">Content</a>
              <a class="inner-nav-link" aria-current="page" href="{{route('quiz.manage', $courseId)}}">Quizzes</a>
              <a class="inner-nav-link" aria-current="page" href="{{route('students.all')}}">Manage Enrollees</a>

            @endif
            
          @endif
      @endauth
        

        @yield('left-side-nav-inside')
      </ul>
      
      <span class="d-flex">
        @yield('right-side-nav-inside')
        @auth
          @if(Auth::user()->userType == '0')
            
          @endif
        @endauth
      <!-- <a class="nav-link" href="#">Login</a>
      <a class="nav-link" href="#">Register</a> -->
      </span>
    </div>
  </div>
</nav>
</body>
</html>