
<!-- Course modal content --> 

    <!-- Course form action -->
    @section('form-action')
        {{route('course.create')}}
    @stop
    @section('mode')
        Create Course
    @stop

    <!-- First label & Input -->
    @section('first-label')
        Course title
    @stop
    @section('first-input')
        course_title
    @stop
    <!--  -->
    
    @section('second-label')
        Course description
    @stop
    @section('second-input')
        course_title
    @stop

    <!--  -->