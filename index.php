<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>Esileht</title> <!--  Lehe nimi -->
     <link rel="stylesheet" type="text/css" media="screen" href="style.css">
     <!-- Bootstrap CDN -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
     integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
     crossorigin="anonymous">
     <!-- Jquery CDN -->
     <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="scripts/onDocumentReady.js"></script> 
 </head>
 <body>
    <div class="container">
        <div id="header"></div>
        <!-- Pilt algab -->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="images/Main.png" alt="Leia endale sobilik eraõpetaja">
                    <div class="carousel-caption hidden-lg visible-sm visible-md">
                            <h2 id="MainCaption">Leia endale sobilik eraõpetaja</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pilt lõpeb -->
        <div class="row" id="HelpCaption"> <!-- visible when size < 445 -->
            <div class="col">
                <h1>Leia endale sobilik eraõpetaja</h1> 
            </div>
        </div>
        <!-- siin algab lehe custom html -->
        <div class="row">
            <div class="col-md-4">
                <img class="d-block " src="images/1.png" height="200px" width="100%">
            </div>
            <div class="col-md-6">

                <div class="row h-50 align-content-center" style="Padding-left:15px;"> 
                    <h3>Mugav otsing</h3>
                </div>

                <div class="row" style="Padding-left:15px;">
                    <h5>Mitmed filtrid sorteerimiseks<h5/>
                </div>
               
            </div>
        </div>
        <div id="elementWithBackground">
                <div id="transparentElement"> 
                    <div class="row h-100">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div class="row h-50 align-content-center" style="Margin-left:15px;"> 
                                <h3>Õpetaja kirjeldus</h3>
                            </div>
                            <div class="row" style="Margin-left:15px;">
                                <h5>Põhjalik kirjeldus õpetajast<h5/>
                            </div>  
                        </div>
                    </div>
                </div>
        </div>             
        <div class="row">
            <div class="col-md-4">
                <img class="d-block " src="images/2.png" height="200px" width="100%">
            </div>
            <div class="col-md-6">

                <div class="row h-50 align-content-center" style="Padding-left:15px;"> 
                    <h3>Lihtne ühendust võtta</h3>
                </div>
    
                <div class="row" style="Padding-left:15px;">
                    <h5>Võta kontakt õpetajaga läbi e-maili või telefoni<h5/>
                </div>
                
            </div>
        </div>
        <div id="elementWithBackground2">
            <div id="transparentElement2"> 
                <div class="row h-100 align-content-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <input type="button" class="btn btn-outline-light" value="Logi sisse" id="HomeSignIn">
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <input type="button" class="btn btn-outline-light" value="Registreeri" id="HomeSignUp">
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div> 
        <script>
            $("#HomeSignIn").click(function(){ window.location = "signIn.php";   });
            $("#HomeSignUp").click(function(){ window.location = "SignUp.php";   });
        </script>
        <!-- siin lõpeb lehe custom html -->
        <div id="footer"></div> 
    </div>
 </body>
<script src="scripts/sizeDetector.js"></script>
 <!-- CDN Bootstrap -->
 <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </html>