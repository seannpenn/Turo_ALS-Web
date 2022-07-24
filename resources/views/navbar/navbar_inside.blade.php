<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src= "{{ asset('js/bootstrap.js') }}" ></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">Create Course</a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @yield('left-side-nav-inside')
      </ul>
      
      <span class="d-flex">
        @yield('right-side-nav-insite')
      <!-- <a class="nav-link" href="#">Login</a>
      <a class="nav-link" href="#">Register</a> -->
      </span>
    </div>
  </div>
</nav>
</body>
</html>