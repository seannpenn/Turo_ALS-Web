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
                            </p>
                            <p>
                                If you don't have your LRN with you, you may leave it blank. A LRN will be provided to you once your enrollment is already approved.
                            </p>
                            <div class="button-area">
                                <button type="submit" id="contentCreate" class="btn btn-warning"><a href="{{route('student.enrollment')}}"><b>Enroll online!</b></a></button>
                            </div>
                        </div>
                    </tr>
                    <!-- STEP 3 -->
                    <tr>
                        <button type="button" class="collapsible"><b>STEP 3: ENROLLMENT REVIEW AND STATUS</b></button>
                    </tr>
                    <tr>
                        
                        <div class="content">
                        @if($enrolleeInfo)
                            <p>
                                Enrollment status: {{$enrolleeInfo->status}}
                            </p>
                            <p>
                                Your LRN: {{$enrolleeInfo->student->information->LRN != null ? $enrolleeInfo->student->information->LRN : 'LRN unavailable'}} 
                            </p>
                            @if($enrolleeInfo->student->enrollment->status == 'approved')
                                <h3>You are officialy enrolled.</h3>

                                <p>You may now download the mobile app in the play store.</p>
                                <div class="buttons justify-content-center mt-3">
                                    <button class="btn btn-dark app-button"><i class="fa fa-play fa-2x"></i><span class="text-uppercase ml-2">Play store</span></button>
                                </div>
                                <br><br>
                                <h4>Steps in using the TURO mobile app:</h4>
                                <ul>
                                    <li>
                                        Input your login credentials
                                    </li>
                                    <li>
                                        Once login, the courses for your program is already visible.
                                    </li>
                                    <li>
                                        The name of your teacher and the location you are enrolled to is also stated in your feed.
                                    </li>
                                </ul>
                            @endif
                        @else
                            Student record not found. 
                        @endif
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