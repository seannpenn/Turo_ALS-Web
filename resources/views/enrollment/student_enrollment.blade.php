@extends('main')

@section('css-style')
    .layout{
        font-family: 'Montserrat';
        margin: 0 auto;
        border: 1 solid;
        width: 100%;
        align-items: center;
        justify-content: center;
    }
    .layout .enrollment-content{
        margin: 100px auto;
        max-width: 800px;
        text-align:center;
        justify-content:center;
        padding: 20px;
    }
    .requirements{
        text-align: justify;
    }
    .collapsible {
        margin-bottom: 10px;
        background-color: orange;
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        text-align: left;
        outline: none;
        font-size: 25px;
        border: none;
        border-radius: 5px;
    }

     .collapsible:hover {
        background-color: #555;
    }
    .content {
        margin-bottom: 10px;
        font-size: 20px;
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
        text-align: justify;
    }
@stop



@section('main-content')

    

    <div class="layout">
        <div class="enrollment-content">
            <h2>
                <b>Steps for enrollment in ALS</b>
                <br>
                <br>
            </h2>

            <section class="requirements"> 
                <table class="table">
                    <tr>
                        <button type="button" class="collapsible"><b>STEP 1: CONTACT AN ALS FACILITATOR</b></button>
                    </tr>
                    <tr>
                        <div class="content">
                            <p>
                                All new ALS applicants must confront an als facilitator in order to be evaluated on what program you need to enroll to.
                            </p>
                            <p>
                                ALS applicants must also inquire for the availability of the program they intend to enroll.
                            </p>
                        </div>
                    </tr>
                    <!-- STEP 2 -->
                    <tr>
                        <button type="button" class="collapsible"><b>STEP 2: SUBMIT AN APPLICATION</b></button>
                    </tr>
                    <tr>
                        <div class="content">
                            <p>
                                Click the enroll button to start filling up the enrollment form.
                                <div class="button-area">
                                    <button type="submit" id="contentCreate" class="btn btn-warning"><a href="{{route('student.enrollment')}}"><b>Enroll online!</b></a></button>
                                </div>
                            </p>
                        </div>
                    </tr>
                    <!-- STEP 3 -->
                    <tr>
                        <button type="button" class="collapsible"><b>STEP 3: ENROLLMENT REVIEW AND STATUS</b></button>
                    </tr>
                    <tr>
                        <div class="content">
                            <p>
                                Enrollment status: {{Auth::user()->student->status}}
                            </p>
                        </div>
                    </tr>
                </table>
                
                
                
            </section>
        </div>
    </div>

    
    <script>
           var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
            }
    </script>
    
@stop