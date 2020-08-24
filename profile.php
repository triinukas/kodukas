<?php

    include 'connectDB.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    if(isset($_POST["changePassword1"]) &&
        isset($_POST["changePassword2"]) &&
        isset($_POST["oldPassword"])){
           
            if($_POST["changePassword1"] != $_POST["changePassword2"]){
                exit("password 1 and password 2 are not equal");
            }

            $email =  $_SESSION['userEmail'];
            $oldPassword = $_POST["oldPassword"];
            $newPassword = password_hash($_POST["changePassword1"], PASSWORD_DEFAULT);

            $result = $conn->query("SELECT * FROM user WHERE email = '$email'");
            if($result->num_rows == 1) { 

                while($row = $result->fetch_assoc()) {
                    if (password_verify($oldPassword, $row["password"])) { 
                                    
                        $sql = "UPDATE user SET password='$newPassword' WHERE email = '$email'";

                        if (mysqli_query($conn, $sql)) {
                            $_POST = array();
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }
                    } else {
                        exit("Old password is not correct");
                    }
                }

            } else {
               exit("Some ErrOR");
            }
            $conn->close();
    }
    if(isset($_POST["firstname"])   && isset($_POST["lastName"]) &&
        isset($_POST["email"])      && isset($_POST["phone"]) && 
        isset($_POST["birthday"]) &&
        isset($_POST["profession"]) && isset($_POST["hourlyPay"]) && 
        isset($_POST["education"])  && isset($_POST["bioTextArea"]) &&
        isset($_POST["maakonnad"])){
        
        //isset($_POST["customFile"]) &&

        
        $studentCheck = false;
        $tutorCheck = false;
        $internetCheck = false;

        if(isset($_POST["studentCheck"])){
            $studentCheck = true;
        }
        if(isset($_POST["tutorCheck"])){
            $tutorCheck = true;
        }
        if(isset($_POST["internetCheck"])){
            $internetCheck = true;
        }

        $town = "";
        $language = "";
        $subject = "";

        $maakonnad = "";

        foreach($_POST["maakonnad"] as $key => $value){
            $maakonnad .= $value.',';
        }
        foreach ($_POST as $key => $value) {
            if (strpos($key, "town") !== false) {
                $town .= $value.',';
            }
           if (strpos($key, "language") !== false) {
                $language .= $value.',';
            }
            if (strpos($key, "subject") !== false) {
                $subject .= $value.',';
            }
        }

        if($town == ""){
            exit("Linn, asula - väli on tühi");
        }
        else if($language == ""){
            exit("Keel - väli on tühi");
        }
        else if($subject == ""){
            exit("Aine/ala - väli on tühi");
        }

        // echo $maakonnad; echo "<br>";
        // echo $town; echo "<br>";
        // echo $language; echo "<br>";
        // echo $subject;

        include 'connectDB.php';

        $result = $conn->query("SELECT * FROM tutor WHERE user_id = '".$_SESSION['userId']."'");
        if($result->num_rows == 1) {
            
            include 'uploadImage.php';

            $sql = 
            "UPDATE tutor 
             SET firstname = '".$_POST['firstname']."', surname = '".$_POST['lastName']."',
                 email = '".$_POST['email']."', phone = '".$_POST['phone']."',
                 phone = '".$_POST['phone']."', image = '".$final_image."',
                 birthday = '".$_POST['birthday']."', profession = '".$_POST['profession']."',
                 at_the_student = '".$studentCheck."', at_the_teacher = '".$tutorCheck."',
                 through_the_internet = '".$internetCheck."', hourly_pay = '".$_POST['hourlyPay']."',
                 education = '".$_POST['education']."', biography = '".$_POST['bioTextArea']."',
                 counties = '".$maakonnad."', town = '".$town."', language = '".$language."',
                 subject = '".$subject."'
             WHERE user_id = '".$_SESSION['userId']."'";

            if ($conn->query($sql) === TRUE) {
                $_POST = array();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            exit("Error? lol");
        }
        $conn->close();
    }
    if($_SESSION["isTutor"] == false) {
        echo '<style>
                #tutorCanvasDivId {
                    display:none; 
                }
              </style>';
    } else {
        // echo '<style>
        //         #tutorCanvasDivId {
        //             visibility:visible 
        //         }
        //       </style>';
        include 'connectDB.php';
        $result = $conn->query("SELECT * FROM tutor WHERE user_id = '".$_SESSION["userId"]."'");
        if($result->num_rows == 1) { 
                        
            while($row = $result->fetch_assoc()) {
                $firstname = $row["firstname"]; $surname = $row["surname"];
                $email = $row["email"]; $phone = $row["phone"];
                $image = $row["image"]; $birthday = $row["birthday"];
                $profession = $row["profession"]; $at_the_student = $row["at_the_student"];
                $at_the_teacher = $row["at_the_teacher"]; $through_the_internet = $row["through_the_Internet"];
                $hourly_pay = $row["hourly_pay"]; $education = $row["education"];
                $biography = $row["biography"]; $counties = $row["counties"];
                $town = $row["town"]; $language = $row["language"];
                $subject = $row["subject"];
            }

        } else {
            exit("Some error");
        }
        $conn->close();
    }

?>
<!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8">
    <title>Profiil</title> <!--  Lehe nimi -->
    <link rel="stylesheet" type="text/css" media="screen" href="style.css">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
    crossorigin="anonymous">
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap-select libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <!-- CDN Bootstrap-select -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    

 </head>
    <body>
        <div class="container">
            <div id="header"></div>
            <!-- Pilt algab -->
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/7.png" alt="Leia endale sobilik eraõpetaja">
                        <div class="carousel-caption hidden-lg visible-sm visible-md">
                            <h2 id="MainCaption">Profiil</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pilt lõpeb -->
            <div class="row" id="HelpCaption"> <!-- visible when size < 445 -->
                <div class="col">
                    <h1>Profiil</h1> 
                </div>
            </div>
            <!-- siin algab lehe custom html -->
            <div class="row">
            <div class="col d-flex justify-content-center"> 
                <div class="rounded border border-dark tutorCanvas">
                    <form class="align-self-center" action="profile.php" method="post">
                        <h4 class="row" id="block">Muuda parool</h4>
                        <div class="form-row" id="block">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="changePassword1">Uus parool</label>
                                        <input type="password" class="form-control" name="changePassword1" id="changePassword1" value="" required>
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="changePassword2">Uus parool teine kord</label>
                                        <input type="password" class="form-control" name="changePassword2" id="changePassword2" value="" required>
                                    </div>
                            </div>
                        </div>
                        <div class="form-row" id="block">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="oldPassword">Vana parool</label>
                                        <input type="password" class="form-control" name="oldPassword" id="oldPassword" value="" required>
                                    </div>
                            </div>
                        </div>
                        <div class="form-row" id="block">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="submit" class="form-control btn btn-outline-primary" name="submitPasswordChanges" id="submitPasswordChanges" value="Muuda parool">
                                    </div>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <div class="row">        
                    <div class="col">
                        <div class="rounded border border-dark tutorCanvas" id="tutorCanvasDivId"> 
                            <h4 class="row" id="block">Muuda õpetaja andmed</h4>
                            <form action="profile.php" method="post" enctype="multipart/form-data">
                                <div class="form-row" id="block">
                                    <div class="col">
                                        <div class="form-group">
                                                <label for="firstname">Eesnimi</label>
                                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo isset($firstname)?$firstname:'';?>" required>
                                        </div>
                                        <div class="form-group ">
                                                <label for="lastName">Perekonnanimi</label>
                                                <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo isset($surname)?$surname:'';?>" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                            <div class="form-group ">
                                                    <label for="email">E-mail</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($email)?$email:'';?>" required>
                                            </div>
                                            <div class="form-group ">
                                                    <label for="phone">Telefon</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo isset($phone)?$phone:'';?>" required>
                                            </div>
                                    </div>
                                </div>
                                <div class="form-row" id="block">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="customFile" id="customFile" onchange="validateFileType(this);" accept=".png, .jpg, .jpeg" required>
                                                <label class="custom-file-label" for="customFile">Profiilipilt</label>
                                            </div>
                                            <div class="feedback">Suurus 200x200 ja kus on näha sinu nägu</div>
                                            <img name="profileImage" height="200" width="200" id="profileImage" src="upload/<?php echo isset($image)?$image:'';?>" alt="Profiilipilt">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row" id="block">   
                                    <div class="col">
                                            <div class="form-group ">
                                                    <label for="birthday">Sünniaeg</label>
                                                    <input type="date" class="form-control" name="birthday" id="birthday" value="<?php echo isset($birthday)?$birthday:'';?>" required>
                                            </div>
                                    </div>
                                    <div class="col">
                                            <div class="form-group ">
                                                    <label for="profession">Amet</label>
                                                    <input type="text" class="form-control" name="profession" id="profession" value="<?php echo isset($profession)?$profession:'';?>" required>
                                                    <div class="feedback">Näiteks: Tudeng, Matemaatika õpetaja</div>
                                            </div>
                                    </div>
                                </div>
                                <div class="form-row" id="block">
                                    <div class="col">
                                            
                                        <div class="form-group">
                                            <label>Õppe asukoht:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?php echo isset($at_the_student)?$at_the_student:'';?>" name="studentCheck" id="studentCheck">
                                                <label class="form-check-label" for="studentCheck">
                                                    Õpilase juures
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?php echo isset($at_the_teacher)?$at_the_teacher:'';?>" name="tutorCheck" id="tutorCheck">
                                                <label class="form-check-label" for="tutorCheck">
                                                    Õpetaja juures
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?php echo isset($through_the_internet)?$through_the_internet:'';?>" name="internetCheck" id="internetCheck">
                                                <label class="form-check-label" for="internetCheck">
                                                    Interneti vahendusel
                                                </label>
                                            </div>
                                        </div>
                                        <?php
                                            echo "<script>";
                                            if(isset($at_the_student) && $at_the_student){
                                                echo "$('#studentCheck').prop('checked', true);";
                                            }
                                            if(isset($at_the_teacher) && $at_the_teacher){
                                                echo "$('#tutorCheck').prop('checked', true);";
                                            }
                                            if(isset($through_the_internet) && $through_the_internet){
                                                echo "$('#internetCheck').prop('checked', true);";
                                            }
                                            echo "</script>";
                                        ?>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="hourlyPay">Tunnitasu (EUR)</label>
                                            <input type="number" class="form-control" name="hourlyPay" id="hourlyPay" value="<?php echo isset($hourly_pay)?$hourly_pay:'';?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="education">Haridus</label>
                                            <select class="selectpicker w-100" title="Vali enda kõrgeim" name="education" id="education" value="<?php echo isset($education)?$education:'';?>" required>
                                                    <option value="Põhiharidus">Põhiharidus</option>
                                                    <option value="Kutseharidus">Kutseharidus</option>
                                                    <option value="Keskharidus">Keskharidus</option>
                                                    <option value="Kõrgharidus omandamisel">Kõrgharidus omandamisel</option>
                                                    <option value="Kõrgharidus (bakalaureus)">Kõrgharidus (bakalaureus)</option>
                                                    <option value="Kõrgharidus (magister)">Kõrgharidus (magister)</option>
                                                    <option value="Kõrgharidus (doktor)">Kõrgharidus (doktor)</option>
                                            </select>  
                                        </div>
                                        <?php 
                                             if(isset($education)){
                                                echo "<script>";
                                                echo "$('#education').selectpicker('val', '$education');";
                                                echo "</script>";
                                             }
                                        ?> 
                                    </div>
                                </div>
                                <div class="form-row" id="block">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="bioTextArea">Bio (tutvustav tekst):</label>
                                            <textarea name="bioTextArea" id="bioTextArea" class="form-control" rows="3" required><?php echo isset($biography)?$biography:'';?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row" id="block">
                                    <div class="col">
                                        <div class="form-group">
                                                <label for="maakonnad" class="w-100">Makonnad</label>
                                                <select class="selectpicker" title="Üks või mittu" name="maakonnad[]" id="maakonnad" value="<?php echo isset($counties)?$counties:'';?>" data-size="10" multiple data-live-search="true" required>  
                                                        <option value="Harjumaa">Harjumaa</option>
                                                        <option value="Hiiumaa">Hiiumaa</option>
                                                        <option value="Ida-Virumaa">Ida-Virumaa</option>
                                                        <option value="Jõgevamaa">Jõgevamaa</option>
                                                        <option value="Järvamaa">Järvamaa</option> 
                                                        <option value="Läänemaa">Läänemaa</option>
                                                        <option value="Lääne-Virumaa">Lääne-Virumaa</option>
                                                        <option value="Põlvamaa">Põlvamaa</option>
                                                        <option value="Pärnumaa">Pärnumaa</option>
                                                        <option value="Raplamaa">Raplamaa</option>
                                                        <option value="Saaremaa">Saaremaa</option>
                                                        <option value="Tartumaa">Tartumaa</option>
                                                        <option value="Valgamaa">Valgamaa</option>
                                                        <option value="Viljandimaa">Viljandimaa</option>
                                                        <option value="Võrumaa">Võrumaa</option>
                                                </select>  
                                        </div>
                                    </div>
                                    <?php
                                        if(isset($counties)){


                                            $myArray = explode(',', $counties); 
                                            $counties = "";
                                            foreach ($myArray as $key => $value){
                                                $counties .= '"'.$value.'",';
                                            }
 
                                            echo "<script>";
                                            echo "$('#maakonnad').selectpicker('val', [$counties]);";
                                            echo "</script>";
                                        
                                        }
                                    ?>
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="form-row" id="block">
                                    <div class="col-9">
                                        <div class="form-group">
                                                <label for="town">Linn, asula</label>
                                                <input class="form-control" type="text" value="" id="town">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                            <div class="form-group">
                                                    <label id="btnTownLabel">Lisa</label>
                                                    <input class="form-control btn btn-outline-dark" type="button" value="Lisa" name="btnTown" id="btnTown">
                                            </div>
                                        </div>
                                    </div>
                                <div class="row" id="block">
                                    <table class="table table border rounded">
                                        <thead>
                                            <tr>
                                            <th scope="col">Linn, asula</th>
                                            <th scope="col" class="text-right"></th> 
                                            </tr>
                                        </thead>
                                        <tbody name="townTableBody" id="townTableBody">
                                            <!-- script will fill -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-row" id="block">
                                    <div class="col-9">
                                        <div class="form-group">
                                                <label for="language">Suhtluskeel(ed)</label>
                                                <input class="form-control" type="text" value="" id="language">
                                                <div class="feedback">Eesti, Vene, Inglise...</div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                            <div class="form-group">
                                                    <label id="btnLanguageLabel">Lisa</label>
                                                    <input class="form-control btn btn-outline-dark" type="button" value="Lisa" name="btnLanguage" id="btnLanguage">
                                            </div>
                                        </div>
                                    </div>
                                <div class="row" id="block">
                                    <table class="table table border rounded">
                                            <thead>
                                                <tr>
                                                <th scope="col">Keel</th>
                                                <th scope="col" class="text-right"></th> 
                                                </tr>
                                            </thead>
                                            <tbody name="languageTableBody" id="languageTableBody">
                                                <!-- script will fill -->
                                            </tbody>
                                    </table>
                                </div>
                                <div class="form-row" id="block">
                                    <div class="col-9">
                                        <div class="form-group">
                                                <label for="subject">Aine/Ala mida kavatsed õpetada</label>
                                                <input class="form-control" type="text" value="" id="subject">
                                                <div class="feedback">Matemaatika, Inglise keel, Programmeerimine...</div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                            <div class="form-group">
                                                    <label id="btnSubjectLabel">Lisa</label>
                                                    <input class="form-control btn btn-outline-dark" type="button" value="Lisa" name="btnSubject" id="btnSubject">
                                            </div>
                                        </div>
                                    </div>
                                <div class="row" id="block">
                                    <table class="table table border rounded">
                                            <thead>
                                                <tr>
                                                <th scope="col">Aine/Ala</th>
                                                <th scope="col" class="text-right"></th> 
                                                </tr>
                                            </thead>
                                            <tbody name="subjectTableBody" id="subjectTableBody">
                                                <!-- script will fill -->
                                            </tbody>
                                    </table>
                                </div>
                                <?php
                                    echo "<script>";
                                    include 'scripts/fillFields.js';
                                    echo "</script>";
                                    $myArray = explode(',', $town); 
                                    $town = "";
                                    foreach ($myArray as $key => $value){
                                        echo "<script>";
                                        echo "town = '$value';";
                                        echo "addTownRow();";
                                        echo "</script>";
                                    }
                                    $myArray = explode(',', $language); 
                                    $language = "";
                                    foreach ($myArray as $key => $value){
                                        echo "<script>";
                                        echo "language = '$value';";
                                        echo "addLanguageRow();";
                                        echo "</script>";
                                    }
                                    $myArray = explode(',', $subject); 
                                    $subject = "";
                                    foreach ($myArray as $key => $value){
                                        echo "<script>";
                                        echo "subject = '$value';";
                                        echo "addSubjectRow();";
                                        echo "</script>";
                                    }
                                    echo $subject;
                                ?>
                                <div class="form-row" id="block">
                                    <div class="col">
                                        <div class="form-group">
                                            <input class="form-control btn-outline-primary w-100" type="submit" value="Muuda andmed" id="btnSubmit">
                                        </div>
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div>
                </div>
        <!-- siin lõpeb lehe custom html -->

        <div id="footer"></div> 
        </div>
    </body>

     <!-- Own JavaScript -->
    <script src="scripts/onDocumentReady.js"></script> 
    <script src="scripts/sizeDetector.js"></script>
    <script src="scripts/addRow.js"></script> 
    <script src="scripts/uploadImage.js"></script> 
    <!-- <script src="scripts/fillFields.js"></script>  -->

    

    <!-- CDN Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</html>