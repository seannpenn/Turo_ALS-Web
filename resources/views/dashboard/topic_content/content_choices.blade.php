@extends('main')

<style>
    button{
        width: 7rem;
        height: 7rem;
        
    }
    a{
        text-decoration: none;
    }
</style>
@section('main-content')
    @include('navbar/navbar_inside', ['courseId' => request()->route('courseid') ])
        <div class="d-flex justify-content-center" >
        
            <div class="container" style="width: 800px; background-color: yellow;">
                <div class="d-flex justify-content-between">
                    <h2>What would you like to add?</h2>
                    <a href="{{ URL::previous() }}"><h3>X</h3></a>
                </div>
               
                <div class="modal-body" style="justify-content:center; text-align:center;">
                    <button class="btn btn-outline-warning" href="{{route('html.create', $topicid)}}">HTML Document</button>
                    <button class="btn btn-outline-warning" href="@yield('file_create')">File</button>
                    <button class="btn btn-outline-warning" href="@yield('link_create')">Test Quiz</button>
                </div>
            </div>
        </div>
        
@stop