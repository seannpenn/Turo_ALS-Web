<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <th>No</th>
        <th>name</th>
        <th>Course title</th>

        @foreach($teacherCollection as $index => $teacher)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$teacher->teacher_fname}}</td>
                <td>
                    @foreach($teacher->course as $course)
                        {{$course->course_title}}
                        <br>
                    @endforeach
                </td>
                <td>{{$teacher->course->count()}}</td>
            </tr>
        @endforeach
    </table>

    <table>
        <th>No</th>
        <th>Course title</th>
        <th>Teacher Name</th>
        <th>Course count</th>

        @foreach($courseCollection as $index => $course)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$course->course_title}}</td>
                <td>
                        {{$course->teacher->teacher_fname}}
                </td>
                <td>{{$teacher->course->count()}}</td>
            </tr>
        @endforeach
    </table>
    
    <h1></h1>
    
</body>
</html>