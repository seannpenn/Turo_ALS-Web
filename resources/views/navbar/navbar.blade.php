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
      nav{
        box-shadow: 2px 1px 5px 2px lightgrey;
      }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg bg-light" >
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('landing') }}" style="color: black;">
      <img src="{{ asset('images/logo.png') }}" alt="" width="30" height="24" class="d-inline-block align-text-top">
      TURO
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav justify-content-center">
        <!-- <li class="nav-item">

          <a class="nav-link active" id="homeButton" aria-current="page">Home</a>
        </li> -->
        @yield('left-side-nav')
      </ul>
      
      <span class="d-flex">
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
              window.location.href = "{{ route('landing') }}";
            }
        }); 
</script>
</html>