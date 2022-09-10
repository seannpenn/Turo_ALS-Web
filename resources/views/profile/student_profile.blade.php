@extends('main')

@section('css-style')
    .row{
        justify-content:center;
    }
    #header{
        padding: 10px;  
        border-radius: 10px;
        <!-- background-color: #d2d2d2; -->
    }

    #picture{
        padding: 10px;  
        border-radius: 10px;
        background-color: #FF8E01;
    }

    #info{
        padding-left: 20px;
    }
@stop 


@section('main-content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5" id="picture">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold">{{Auth::user()->student->student_fname}} {{Auth::user()->student->student_mname}} {{Auth::user()->student->student_lname}}</span>
                <span class="text-black-50">{{Auth::user()->email}}</span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="justify-content-between align-items-center mb-1" id="header">
                    <h4 class="text-left fw-bold fs-2">LRN: </label> {{Auth::user()->student->information->LRN}}</h4>
                </div>

                <div class="justify-content-between align-items-center mb-1" id="header">
                    <h4 class="text-left">Basic Info</h4>
                    <hr>
                </div>
                
                <div class="row mt-2" id="info">
                    <div class="col-md-12"><label class="labels">Date of birth: </label> {{Auth::user()->student->information->student_birth}}</div>
                    <div class="col-md-12"><label class="labels">Place of Birth: </label>  {{Auth::user()->student->information->student_placeofbirth}} </div>
                    <div class="col-md-12"><label class="labels">Address: </label> {{Auth::user()->student->information->street}} {{Auth::user()->student->information->barangay}} {{Auth::user()->student->information->city}} {{Auth::user()->student->information->province}}</div>
                    <div class="col-md-12"><label class="labels">Status: </label> {{Auth::user()->student->information->student_civil}} </div>
                </div>
                <br>

                <div class="justify-content-between align-items-center mb-1" id="header">
                    <h4 class="text-left">Contact Info</h4>
                    <hr>
                </div>
                

                <div class="row mt-2" id="info">
                    <div class="col-md-12"><label class="labels">Email: </label> {{Auth::user()->email}}</div>
                    <div class="col-md-12"><label class="labels">Mobile No: </label></div>
                </div>
                <br>
                <div class="justify-content-between align-items-center mb-1" id="header">
                    <h4 class="text-left">Education</h4>
                    <hr>
                </div>
                

                <div class="row mt-2" id="info">
                    <div class="col-md-12"><label class="labels">Previous Education Level: </label> {{Auth::user()->student->education->last_level}}</div>
                    <div class="col-md-12"><label class="labels">Program Attended: </label></div>
                </div>
                <br>
                <div class="justify-content-between align-items-center mb-1" id="header">
                    <h4 class="text-left">Family & Relationships</h4>
                    <hr>
                </div>
                

                <div class="row mt-2" id="info">
                    <div class="col-md-12"><label class="labels">Mother: </label> {{Auth::user()->student->family->student_motherfname}} {{Auth::user()->student->family->student_mothermname}} {{Auth::user()->student->family->student_motherlname}}</div>
                    <div class="col-md-12"><label class="labels">Mother: </label> {{Auth::user()->student->family->student_compfname}} {{Auth::user()->student->family->student_compmname}} {{Auth::user()->student->family->student_complname}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@stop