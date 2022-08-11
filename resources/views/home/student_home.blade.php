@extends('main')
<!--//for outer navbar//-->



@section('css-style')
    .layout{
        margin: 0 auto;
        border: 1 solid;
        width: 100%;
        align-items: center;
        justify-content: center;
    }
    
    .work {
        max-width: 900px;
        padding: 0 24px;
        margin: 150px auto;
        margin-bottom: 32px;
        border-radius: 5px;
        background-color: #f9fafb;
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

    
    .banner-image {
        height: 400px;
        width: 100%;
        background-color: #FF8E01;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        justify-content:center;
        display:flex;
    }
    .gallery-image{
        position: absolute;
        margin: 250px auto;
    }
    
    .gallery-row{
        justify-content:center;
        display:flex;  
    }
    .container .image{
        width: 400px;
        height: 300px;
        border-radius: 5px;
        box-shadow: 0px 5px 10px grey;
        transition: transform .4s;
    }
    .image:hover {
        transform: scale(1.5);
    }

    .message{
        width: 100%;
        height: 400px;
        text-align: left;
        justify-content:center;
        padding: 0 24px;
    }
    .message h2{
        color:white;
        font-size: 3em;
    }
    .home-container h1{
        letter-spacing: 8px;
    }
    .home-content{
        max-width: 1000px;
        margin: 200px auto;
        text-align:center;
        justify-content:center;
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
    .logo{
        margin: 10px auto;
        position:absolute;
        text-align:center;
        width: 1000px;
    }
    .icons{
        width:150px;
        height: 130px;
    }
    .button-area{
        margin: 0 auto;
        margin-top" 500px;
        background-color: yellow;
        max-width: 1500px;
    }
    .button-area .enroll{
        display: flex;
        margin: 0 auto;
    }
    .site-footer {
        padding: 42px 24px;
        text-align: center;
        /* background-color: #f9fafb; */
        background-color: #eceff1dc;
    }

    .site-footer p {
        margin: 0;
        color: #4b5563;
    }
@stop

@section('main-content')

    <div class="layout">
        <div class="banner-image">
            
            <div class="logo">
                <img class="icons"src="{{ asset('images/deped_logo.png') }}" alt="">
                <img class="icons"src="{{ asset('images/als.png') }}" alt="">
            </div>
            <div class="message">
                <h2>Hello, {{Auth::user()->username}}</h2>
            </div>

            

            <div class="gallery-image">
                <div class="gallery-row">
                    <div class="container">
                        <img class="image" id="left" src="{{ asset('images/ALS/elder.jpg') }}"  alt="">
                    </div>
                    <div class="container">
                        <img class="image" id="right" src="{{ asset('images/ALS/2-3.jpg') }}"  alt="">
                    </div>
                
                    <div class="container">
                        <img class="image" id="left" src="{{ asset('images/ALS/img1319.jpg') }}" alt="">
                    </div>
                    <div class="container">
                        <img class="image" id="right" src="{{ asset('images/ALS/graduate.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="home-content">
            <div class="home-container">
                <h1>Programs offered by ALS</h1>
                <button type="button" class="collapsible">BASIC LITERACY PROGRAM</button>
                <div class="content">
                    <p>
                        The Basic Literacy Program (BLP) is a program component of ALS aimed at eradicating
                        illiteracy among OSYA, and in extreme cases, school-aged children, 
                        by developing the basic literacy skills of reading, writing, and numeracy.
                    </p>
                </div>
                <button type="button" class="collapsible">ACCREDICATION AND EQUIVALENCY PROGRAM</button>
                <div class="content">
                    <p>
                        The Accreditation and Equivalency (A&E) Program is a program component of ALS aimed 
                        at providing an alternative pathway of learning for OSYA who have the basic literacy 
                        skills but have not completed the K to 12 basic education mandated by the Philippine 
                        Constitution. Through this program, school dropouts are able to complete elementary 
                        and high school education outside the formal school system.
                    </p>
                </div>
                <button type="button" class="collapsible">INDIGENOUS PEOPLES EDUCATION</button>
                <div class="content">
                    <p>
                        The Indigenous Peoples Education is a research and development project which aims to provide 
                        basic education support services to IP communities. This is initially implemented at the tribal 
                        communities in Dumalneg, Ilocos Norte, Gen. Nakar, Quezon, and Botolan, Zambales.
                    </p>
                </div>
                <button type="button" class="collapsible">ALTERNATIVE LEARNING SYSTEM FOR DIFFERENTLY-ABLED PERSONS (ALS-DAP)</button>
                <div class="content">
                    <p>
                        The Alternative Learning System for Differently-Abled Persons (ALS-DAP) is a project which aims to deliver Basic Literacy 
                        Program to the special/differently-abled children/OSYs/adults, e.g., hearing impaired learners who have not availed of/have 
                        no access to the formal school system through specialized approaches, e.g., sign language.
                    </p>
                </div>
                <button type="button" class="collapsible">PARENT EDUCATION</button>
                <div class="content">
                    <p>
                        The Parent Education is an informal education which is a life skills short-term course that addresses the special needs and 
                        interests of the parents to promote pride in their work and ownership of their responsibilities as members of the family and their 
                        community.
                    </p>
                </div>
                <button type="button" class="collapsible">INFORMAL EDUCATION FOR DISADVANTAGED CHILDREN</button>
                <div class="content">
                    <p>
                    This program focuses on packaging of short-term educational activity that addresses the special needs and interests of the street and 
                    working children. It intends to use life skills active learning approaches/strategies aimed at developing/enhancing social, civic, 
                    aesthetic, cultural, recreational physical and personal development. The learning materials/packages may be developed/adopted/adapted 
                    or gathered from other sources and tailored-fit to the identified needs of the said users.
                    </p>
                </div>
            </div>
        </div>
        <footer class="site-footer">
            <p>Turo Development</p>
        </footer>
       

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

