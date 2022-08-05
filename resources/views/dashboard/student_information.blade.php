@extends('main')

@section('css-style')
    
        #registration-form {
            margin: 0 auto;
            width: 1000px;
            height: 300px;
            border: 1 solid;
        }
        h2{
            text-align:center;
        }
        button{
            text-align:center;
        }
        label {
            display: inline-block;
            width: 400px;
        }
        
        select {
            width: 200px;
            text-overflow: ellipsis;
            margin-bottom: 10px;
        }
@stop  

@section('main-content')
<section id="application-form">
        <br>
        <h2>Student Application</h2>
        
        <br>
        
            {{ csrf_field() }}
            <!-- For login details -->
            <label for=""><b>Personal Information (Part 1)</b></label>
            <hr>
            
            
            <input type="text" name="userType"  class="form-control" id="inputEmail3" value="0" hidden>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">LRN (if available): </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">{{$studentPersonal['LRN']}} </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Full name: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Gender: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>
            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Civil status: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>
            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Date of Birth: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Address: </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Mother's Maiden Name </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>
            
           
            <br>
            <label for="">Educational Information (Part 2)</label>
            <hr>
            
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Last Grade Level Completed </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Attended ALS sessions before? </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>
            </div>
            <label for="basic-url" class="form-label">If yes, </label>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Name of Program </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>
            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Level of literacy </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Year attended </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>

            <br>
            <label for=""><b>Files submitted (Part 3)</b></label>
            <hr>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Year attended </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Year attended </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>

            <div class="input-group mb-3">
                <label for="student_LRN" class="col-sm-4 col-form-label">Year attended </label>
                <label for="student_LRN" class="col-sm-2 col-form-label">info </label>

            </div>


            <br>
            
            
            <br>
            <div class="d-grid gap-1 col-3 mx-auto">
                <button type="submit" class="btn btn-primary" type="button">Approve enrollment</button>
            </div>
            <br>
    </section>
@stop