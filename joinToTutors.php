<?php        
    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION["isTutor"])){
        header("Location:profile.php");
    }
    if(!isset($_SESSION["username"])){
        echo '<script> alert("Logi sisse"); </script>';
        echo '<script> window.location.replace("signIn.php"); </script>';
        //header("Location:signIn.php");
    }

    if(isset($_POST["firstname"])   && isset($_POST["lastName"]) &&
        isset($_POST["email"])      && isset($_POST["phone"]) && 
        isset($_POST["birthday"]) &&
        isset($_POST["profession"]) && isset($_POST["hourlyPay"]) && 
        isset($_POST["education"])  && isset($_POST["bioTextArea"]) &&
        isset($_POST["maakonnad"])){
        
        // isset($_POST["customFile"]) why its not set when use enctype="multipart/form-data" in form?
        
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
        if($result->num_rows == 0) {

            include 'uploadImage.php';
            
            $sql = "INSERT INTO tutor(user_id, firstname, surname, email, phone, image, birthday, profession,
            at_the_student, at_the_teacher, through_the_internet, hourly_pay, education, biography, counties, town, language, subject)
            VALUES('".$_SESSION['userId']."', '".$_POST['firstname']."', '".$_POST['lastName']."' 
            , '".$_POST['email']."', '".$_POST['phone']."', '".$final_image."'
            , '".$_POST['birthday']."', '".$_POST['profession']."', '".$studentCheck."'
            , '".$tutorCheck."', '".$internetCheck."', '".$_POST['hourlyPay']."'
            , '".$_POST['education']."', '".$_POST['bioTextArea']."', '".$maakonnad."'
            , '".$town."', '".$language."', '".$subject."'
            )";

            if ($conn->query($sql) === TRUE) {
                $_SESSION["isTutor"] = true;
                $_POST = array(); 
                
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

           

        } else {
            exit("user_id is already referred");
        }
        $conn->close();
    }

?>
<!DOCTYPE html>
 <html>
    <head>
        <meta charset="utf-8">
        <title>Liitu õpetajana</title> <!--  Lehe nimi -->
        <link rel="stylesheet" type="text/css" media="screen" href="style.css">
        <!-- CDN Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
        <!-- CDN Jquery -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap-select libraries -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    </head>
    <body>
        <div class="container">
            <div id="header"></div>
            <!-- Pilt algab -->
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/5.png" alt="Leia endale sobilik eraõpetaja">
                        <div class="carousel-caption hidden-lg visible-sm visible-md">
                            <h2 id="MainCaption">Liitu õpetajana</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pilt lõpeb -->
            <div class="row" id="HelpCaption"> <!-- visible when size < 445 -->
                <div class="col">
                    <h1>Liitu õpetajana</h1> 
                </div>
            </div>
            <!-- siin algab lehe custom html -->
            <div class="row">
                <div class="col">
                    <div class="rounded border border-dark tutorCanvas">
                    <h4 class="row" id="block">Õpetaja andmed</h4>
                        <form enctype="multipart/form-data" action="joinToTutors.php" method="post">
                            <div class="form-row" id="block">
                                <div class="col">
                                    <div class="form-group">
                                            <label for="firstname">Eesnimi</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="" required>
                                    </div>
                                    <div class="form-group ">
                                            <label for="lastName">Perekonnanimi</label>
                                            <input type="text" class="form-control" name="lastName" id="lastName" value="" required>
                                    </div>
                                </div>
                                <div class="col">
                                        <div class="form-group ">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control" name="email" id="email" value="" required>
                                        </div>
                                        <div class="form-group ">
                                                <label for="phone">Telefon</label>
                                                <input type="text" class="form-control" name="phone" id="phone" value="" required>
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
                                        <img name="profileImage" height="200" width="200" id="profileImage" src="#" alt="Profiilipilt" style="visibility: hidden;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" id="block">
                                <div class="col">
                                        <div class="form-group ">
                                                <label for="birthday">Sünniaeg</label>
                                                <input type="date" class="form-control" name="birthday" id="birthday" value="" required>
                                        </div>
                                </div>
                                <div class="col">
                                        <div class="form-group ">
                                                <label for="profession">Amet</label>
                                                <input type="text" class="form-control" name="profession" id="profession" value="" required>
                                                <div class="feedback">Näiteks: Tudeng, Matemaatika õpetaja</div>
                                        </div>
                                </div>
                            </div>
                            <div class="form-row" id="block">
                                <div class="col">
                                        
                                     <div class="form-group">
                                        <label>Õppe asukoht:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" name="studentCheck" id="studentCheck">
                                            <label class="form-check-label" for="studentCheck">
                                                Õpilase juures
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" name="tutorCheck" id="tutorCheck">
                                            <label class="form-check-label" for="tutorCheck">
                                                Õpetaja juures
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" name="internetCheck" id="internetCheck">
                                            <label class="form-check-label" for="internetCheck">
                                                Interneti vahendusel
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="hourlyPay">Tunnitasu (EUR)</label>
                                        <input type="number" class="form-control" name="hourlyPay" id="hourlyPay" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="education">Haridus</label>
                                        <select class="selectpicker w-100" title="Vali enda kõrgeim" name="education" id="education" required>
                                                <option value="Põhiharidus">Põhiharidus</option>
                                                <option value="Kutseharidus">Kutseharidus</option>
                                                <option value="Keskharidus">Keskharidus</option>
                                                <option value="Kõrgharidus omandamisel">Kõrgharidus omandamisel</option>
                                                <option value="Kõrgharidus (bakalaureus)">Kõrgharidus (bakalaureus)</option>
                                                <option value="Kõrgharidus (magister)">Kõrgharidus (magister)</option>
                                                <option value="Kõrgharidus (doktor)">Kõrgharidus (doktor)</option>
                                        </select>  
                                    </div> 
                                </div>
                            </div>
                            <div class="form-row" id="block">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="bioTextArea">Bio (tutvustav tekst):</label>
                                        <textarea name="bioTextArea" id="bioTextArea" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" id="block">
                                <div class="col">
                                    <div class="form-group">
                                            <label for="maakonnad" class="w-100">Makonnad</label>
                                            <select class="selectpicker" title="Üks või mittu" name="maakonnad[]" id="maakonnad" data-size="10" multiple data-live-search="true" required>  
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
                            <div class="form-row" id="block">
                                <div class="col">
                                    <div class="form-group">
                                        <input class="form-control btn-outline-primary w-100" type="submit" value="Salvesta" id="btnSubmit">
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

    <!-- CDN Bootstrap-select -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    
    <!-- CDN Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 </html>