<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION["username"])){
        header("Location:search.php");
    }

    if(isset($_POST["username"]) &&
        isset($_POST["email"]) &&
        isset($_POST["pasword"]) &&
        isset($_POST["paswordAgain"])){
            
            if($_POST["pasword"] !== $_POST["paswordAgain"]){
                exit("pasword and paswordAgain are not equal");
            }

            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = password_hash($_POST["pasword"], PASSWORD_DEFAULT);
            include 'connectDB.php';

            $result = $conn->query("SELECT email FROM user WHERE email = '$email'");
            if($result->num_rows == 0) {
                $sql = "INSERT INTO user (email, username, password)
                        VALUES ('$email', '$username', '$password')";

                if ($conn->query($sql) === TRUE) {
                    $_POST = array();
                    header("Location:signIn.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

            } else {
               exit("This email already exists");
            }

            $conn->close();
    }
?>



<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>Registreeri</title> <!--  Lehe nimi -->
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
                    <img class="d-block w-100" src="images/8.png" alt="Leia endale sobilik eraõpetaja">
                    <div class="carousel-caption hidden-lg visible-sm visible-md">
                        <h2 id="MainCaption">Registreeri</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pilt lõpeb -->
        <div class="row" id="HelpCaption"> <!-- visible when size < 445 -->
            <div class="col">
                <h1>Registreeri</h1> 
            </div>
        </div>
        <!-- siin algab lehe custom html -->
        <div class="row">
            <div class="col">
                <div class="rounded border border-dark tutorCanvas">
                    <form action="signUp.php" method="post">
                        <div class="form-row" id="block">
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label for="username">Kasutajanimi</label>
                                        <input type="text" class="form-control" name="username" id="username" value="" required>
                                </div>
                                <div class="form-group ">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email" value="" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                        <label for="pasword">Parool</label>
                                        <input type="password" class="form-control" name="pasword" id="pasword" value="" required>
                                </div>
                                <div class="form-group ">
                                        <label for="paswordAgain">Parool uuesti</label>
                                        <input type="password" class="form-control" name="paswordAgain" id="paswordAgain" value="" required>
                                </div>                        
                            </div>
                        </div>  
                        <div class="form-row" id="block">
                            <div class="col-6">
                                <div class="form-group ">
                                    <input type="submit" class="form-control btn btn-outline-primary" name="regSubmit" id="regSubmit" value="Registreeri" required>
                                <div>
                            </div>
                        </div>
                    </form>
                    <script>
                        // if the passwords are equal
                        $("#regSubmit").click(function(){
                            if($("#pasword").val() != $("#paswordAgain").val()){
                                alert("Password 1 ja password 2 ei ole võrtsed");
                                $('form').attr('onsubmit','return false;');
                            } else {
                                $('form').attr('onsubmit','return true;');
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
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