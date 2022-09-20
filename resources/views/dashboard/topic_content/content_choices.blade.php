@extends('main')

@section('main-content')
    @include('navbar/navbar_inside', ['courseId' => request()->route('id') ])
        <div class="d-flex justify-content-center">
            <div class="modal-body" style="justify-content:center; text-align:center;">
                <button class="btn btn-warning"><a href="{{route('html.create', $topic_id)}}" style="color:white; text-decoration: none; padding: 10px;">HTML Document</a></button>
                <button class="btn btn-warning"><a href="@yield('file_create')" style="color:white; text-decoration: none; padding: 10px;">File</a></button>
                <button class="btn btn-warning"><a href="@yield('link_create')" style="color:white; text-decoration: none; padding: 10px;">Test Quiz</a></button>
            </div>
        </div>
        
@stop