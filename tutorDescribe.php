<?php 

    if (!isset($_SESSION)) {
        session_start();
    }

    if(isset($_GET['getTutorId'])){

        $tutorData = array();

        include 'connectDB.php';
        $result = $conn->query("SELECT * FROM tutor WHERE id = '".$_GET["getTutorId"]."'");
        if($result->num_rows == 1) { 
                        
            while($row = $result->fetch_assoc()) {
                $tutorData = $row;
            }
            // deleting "," if last char
            foreach ($tutorData as $key => $value) {
                if(substr($value, -1) == ","){
                    $tutorData[$key] = substr_replace($tutorData[$key], "", -1);
                    // echo $tutorData[$key];
                }
            }

        } else {
            exit("Some error");
        }
        $conn->close();        
    } else {
        die("setTutorId");
    }

?>
<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>Lehe nimi</title> <!--  Lehe nimi -->
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
                    <img class="d-block w-100" src="images/6.png" alt="Leia endale sobilik eraõpetaja">
                    <div class="carousel-caption hidden-lg visible-sm visible-md">
                        <h2 id="MainCaption">Õpetaja kirjeldus</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pilt lõpeb -->
        <div class="row" id="HelpCaption"> <!-- visible when size < 445 -->
            <div class="col">
                <h1>Õpetaja kirjeldus</h1> 
            </div>
        </div>
        <!-- siin algab lehe custom html -->
         
        <div class="describeBox">
            <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-4" id="describeBoxLeft">
                                <img src="Images/1.png" width="100%" height="100%" id="describeProfileImage">
                            </div>
                            <div class="col-8">
                                <div id="describeBoxRight">
                                    <div class="row">
                                        <h5 id="describeName">Eesnimi: Kaarel Tiik</h5>
                                    </div>
                                    <div class="row">
                                        <p id="describeBirthday">Sünniaeg: 12.4.1998</p>
                                    </div>
                                    <div class="row">
                                        <p id="describeLanguage">Suhtluskeeled: Eesti keel, Vene keel, Inglise keel</p>
                                    </div>
                                    <div class="row">
                                        <p id="describeEducation">Haridus: Kõrgharidus</p>
                                    </div>
                                    <div class="row">
                                        <p id="describeHourlyPay">Tunnitasu: 20 EUR</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"id="describeBoxBottom">
            
                                <div class="col-4" id="describeBoxLeftBottom">
                                    <div class="row">
                                            <div class="form-group" id="describeBoxLeftBottomCheckForm">
                                                    <br>
                                                    <label><h5>Õppe asukoht:</h5></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" name="studentCheck" id="describeStudentCheck" disabled >
                                                        <label class="form-check-label" for="describeStudentCheck">
                                                            Õpilase juures
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" name="tutorCheck" id="describeTutorCheck" disabled>
                                                        <label class="form-check-label" for="describeTutorCheck">
                                                            Õpetaja juures
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" name="internetCheck" id="describeInternetCheck" disabled>
                                                        <label class="form-check-label" for="describeInternetCheck">
                                                            Interneti vahendusel
                                                        </label>
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h5>Amet: </h5>
                                            <p id="describeProfession">Õpetaja</p>
                                        </div>                                    
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <h5>Asukoht: </h5>
                                            <p id="describeTown">Tallinn</p>
                                        </div>                           
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <h5>Ained/alad: </h5>
                                            <p id="describeSubject">Matemaatika</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <h5>Maakond: </h5>
                                            <p id="describeCounties">Harjumaa</p>
                                        </div>
                                    </div>                      
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col"> 
                                            <h5>Bio(tutvustus)</h5>
                                            <p id="describeTutorDescribe">dddddddddddddddddddddddddddddddddddddsdsdsdsdsdsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdsdsdsdsdsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p>
                                        </div>
                                        
                                    </div><div class="row" id="describeContact">
                                        <div class="col">
                                            <h5>Kontakt</h5>
                                            <?php 
                                                if(isset($_SESSION['userId'])){
                                                    echo '
                                                        <p id="describeEmail">Email: mail@mail.ee</p>
                                                        <p id="describePhone">Telefon: 0000 0000</p>
                                                    ';
                                                } else {
                                                    echo '<input type="button" id="describeLogin" class="btn btn-outline-primary" value="Logi sisse">';
                                                }
                                            ?>
                                        </div>  
                                    </div>
                                </div>
                                <script>
                                    // fill with tutor data
                                    $("#describeProfileImage").attr("src","upload/<?php echo $tutorData['image']; ?>");
                                    $("#describeName").text("Nimi: <?php echo $tutorData['firstname']." ".$tutorData['surname']; ?>");
                                    $("#describeBirthday").text("Sünniaeg: <?php echo $tutorData['birthday']; ?>");
                                    $("#describeLanguage").text("Suhtluskeeled: <?php echo $tutorData['language']; ?>");
                                    $("#describeEducation").text("Haridus: <?php echo $tutorData['education']; ?>");
                                    $("#describeHourlyPay").text("Tunnitasu: <?php echo $tutorData['hourly_pay']; ?> EUR");
                                    
                                    $("#describeStudentCheck").attr("checked",<?php  if($tutorData['at_the_student'] == 1){ echo "true";} ?>);
                                    $("#describeTutorCheck").attr("checked",<?php  if($tutorData['at_the_teacher'] == 1){ echo "true";} ?>);
                                    $("#describeInternetCheck").attr("checked",<?php  if($tutorData['through_the_Internet'] == 1){ echo "true";} ?>);

                                    $("#describeProfession").text("<?php echo $tutorData['profession']; ?>");
                                    $("#describeTown").text("<?php echo $tutorData['town']; ?>");
                                    $("#describeSubject").text("<?php echo $tutorData['subject']; ?>");
                                    $("#describeCounties").text("<?php echo $tutorData['counties']; ?>");
                                    $("#describeTutorDescribe").text("<?php echo $tutorData['biography']; ?>");

                                    $("#describeEmail").text("E-mail: <?php echo $tutorData['email']; ?>");
                                    $("#describePhone").text("Telefon: <?php echo $tutorData['phone']; ?>");

                                    $("#describeLogin").click(function(){
                                        window.location = "signIn.php";
                                    });



                                </script>       
                        </div>
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