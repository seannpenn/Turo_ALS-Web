<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src= "{{ asset('js/bootstrap.js') }}" ></script>
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    @foreach($ownedCourses as $course)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$course['course_title']}}</h5>
                <p class="card-text">{{$course['course_description']}}</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    @endforeach
</body>
</html>