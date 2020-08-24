<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION["username"])){
        header("Location:search.php");
    }
    

    if(isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])){

            $email = $_POST["inputEmail"];
            $password = $_POST["inputPassword"];
            include 'connectDB.php';

            $result = $conn->query("SELECT * FROM user WHERE email = '$email'");
            if($result->num_rows == 1) {
                
                while($row = $result->fetch_assoc()) {
                    if (password_verify($password, $row["password"])) { 

                        $_SESSION['userId'] = $row["id"];
                        $_SESSION['userEmail'] = $row["email"];
                        $_SESSION['username'] = $row["username"];


                        $result = $conn->query("SELECT * FROM tutor WHERE user_id = '".$_SESSION['userId']."'");
                        if($result->num_rows == 0) {       
                            $_SESSION['isTutor'] = false;
                        } else {
                            $_SESSION['isTutor'] = true;
                        }
        
                        header("Location:search.php");
                    } else {
                        exit("Wrong password or username");
                    }
                }
            } else {
               exit("Wrong password or username");
            }


            
            $conn->close();
             
    }
?>

<!DOCTYPE html>
 <html>
    <head>
        <meta charset="utf-8">
        <title>Logi sisse</title> <!--  Lehe nimi -->
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
                        <img class="d-block w-100" src="images/9.png" alt="Leia endale sobilik eraõpetaja">
                        <div class="carousel-caption hidden-lg visible-sm visible-md">
                            <h2 id="MainCaption">Logi sisse</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pilt lõpeb -->
            <div class="row" id="HelpCaption"> <!-- visible when size < 445 -->
                <div class="col">
                    <h1>Logi sisse</h1> 
                </div>
            </div>
            <!-- siin algab lehe custom html -->
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="rounded border border-dark d-flex justify-content-center"  id="signInBox">
                        <form action="signIn.php" method="post" class="align-self-center">
                            <div class="form-group row" id="block2">
                                <label for="inputEmail" class="col-form-label col-5" id="unm">E-mail</label>
                                <input type="email" name="inputEmail" id="inputEmail" class="form-control col-7" required>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-form-label col-5">Parool</label>
                                <input type="password" name="inputPassword" id="inputPassword" class="form-control col-7" required>
                            </div>
                            <div class="row" >
                                <a href="signUp.php" class="text-decoration-underline col-5 align-self-center">Registreeri</a>           
                                <button type="submit" class="btn btn-outline-primary col-7" id="logInBg">Logi sisse</button>                                                   
                            </div> 
                        </form> 
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