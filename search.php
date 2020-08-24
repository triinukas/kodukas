<?php

    $tutorData = array();
    $languages = array();
    $languagesString = "";
    $subjects = array();
    $subjectsString = "";
    $educations = array();
    $educationString = "";

    include 'connectDB.php';
    $result = $conn->query("SELECT * FROM tutor ");
    if($result->num_rows > 0) { 
                    
        while($row = $result->fetch_assoc()) {
            $tutorData[] = $row;
        }
         // deleting "," if last char
         for($i = 0; $i < count($tutorData); $i++){
            foreach ($tutorData[$i] as $key => $value) {
                if(substr($value, -1) == ","){
                    $tutorData[$i][$key] = substr_replace($tutorData[$i][$key], "", -1);
                    // echo $tutorData[$i][$key];
                }
                //get all languages from database
                if($key == "language"){
                    array_push($languages,explode(",", $value));                  
                }
                if($key == "subject"){
                    array_push($subjects,explode(",", $value));                  
                }
            }
         }
         for($i = 0; $i < count($languages); $i++){
            foreach ($languages[$i] as $key => $value) {
                    $languagesString .= $languages[$i][$key].",";
            }
        }
        $languages = explode(",", $languagesString);
        //hope now it work
        $languages = array_unique($languages);
        $languages = array_filter($languages);

         for($i = 0; $i < count($subjects); $i++){
            foreach ($subjects[$i] as $key => $value) {
                    $subjectsString .= $subjects[$i][$key].",";
            }
        }
        $subjects = explode(",", $subjectsString);
        //hope now it work
        $subjects = array_unique($subjects);
        $subjects = array_filter($subjects);
        // print_r($subjects);


        
    } else {
        exit("Some error");
    }
    $conn->close();
?>
<!DOCTYPE html>
 <html>
    <head>
        <meta charset="utf-8">
        <title>Otsi</title> <!--  Lehe nimi -->
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

    </head>
    <body>
        <div class="container">
            <div id="header"></div>
            <!-- Pilt algab -->
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/10.png" alt="Leia endale sobilik eraõpetaja">
                        <div class="carousel-caption hidden-lg visible-sm visible-md">
                            <h2 id="MainCaption">Otsi eraõpetaja</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pilt lõpeb -->
            <div class="row" id="HelpCaption"> <!-- visible when size < 445 -->
                <div class="col">
                    <h1>Otsi eraõpetaja</h1> 
                </div>
            </div>
            <!-- siin algab lehe custom html -->
            <div class="row" id="primaryRow">
                <div class="col-sm-4" id="searchLeftCol">
                    <div id="searchBox">
                        <form>
                        <!-- <h6>Tunnitasu</h6>
                            <div class="form-row" id="block">
                                <div class="col">
                                    <div class="form-group">
                                            <label for="salaryStart">Alates</label>
                                            <input type="number" class="form-control" name="salaryStart" id="salaryStart" value="" >
                                    </div> 
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="salaryEnd">Kuni</label>
                                        <input type="number" class="form-control" name="salaryEnd" id="salaryEnd" value="" >
                                    </div>
                                </div>
                            </div>
                        <h6>Vanus</h6>
                            <div class="form-row" id="block">
                                <div class="col">
                                    <div class="form-group">
                                            <label for="ageStart">Alates</label>
                                            <input type="number" class="form-control" name="ageStart" id="ageStart" value="" >
                                    </div> 
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="ageEnd">Kuni</label>
                                        <input type="number" class="form-control" name="ageEnd" id="ageEnd" value="" >
                                    </div>
                                </div>
                            </div> -->
                        <h6>Asukoht</h6>
                            <div class="form-row" id="block">
                                <div class="col">
                                    <div class="form-group">
                                    <label for="counties" class="w-100">Makonnad</label>
                                            <select class="selectpicker" title="Üks või mittu" name="maakonnad[]" id="counties" data-size="10" multiple data-live-search="true">  
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
                            </div>
                            <div class="form-row" id="block">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="townSearch">Linn, asula</label>
                                        <input type="text" class="form-control" name="townSearch" id="townSearch" value="" >
                                    </div> 
                                </div>
                            </div>
                            <div class="form-row" id="block">
                                <div class="col">
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
                        <h6>Aine/Ala</h6>
                            <div class="form-row" id="block">
                                <select class="selectpicker" title="Üks või mittu" name="selectSubject[]" id="selectSubject" data-size="10" multiple data-live-search="true">  
                                <?php foreach($subjects as $key):?>

                                    <option value="<?php echo $key;?>"><?php echo $key;?></option>

                                <?php endforeach;?>
                                </select>  
                            </div>
                        <h6>Suhtluskeeled</h6>
                            <div class="form-row" id="block">
                                <select class="selectpicker" title="Üks või mittu" name="selectLanguage[]" id="selectLanguage" data-size="10" multiple data-live-search="true">
                                <?php foreach($languages as $key):?>

                                <option value="<?php echo $key;?>"><?php echo $key;?></option>

                                <?php endforeach;?>
                                </select>  
                            </div>
                        <h6>Haridus</h6>
                            <div class="form-row" id="block">
                                <select class="selectpicker w-100" title="Üks või mittu" name="selectEducation[]" id="selectEducation" data-size="10" multiple data-live-search="true">
                                    <option value="Põhiharidus">Põhiharidus</option>
                                    <option value="Kutseharidus">Kutseharidus</option>
                                    <option value="Keskharidus">Keskharidus</option>
                                    <option value="Kõrgharidus omandamisel">Kõrgharidus omandamisel</option>
                                    <option value="Kõrgharidus (bakalaureus)">Kõrgharidus (bakalaureus)</option>
                                    <option value="Kõrgharidus (magister)">Kõrgharidus (magister)</option>
                                    <option value="Kõrgharidus (doktor)">Kõrgharidus (doktor)</option>
                                </select>  
                            </div>
                        <input type="button" class="btn btn-outline-primary w-100" id="submitSearch" value="Otsi">
                        <input type="button" class="btn btn-outline-danger w-100" id="deleteAllValuesSearch" value="Kustuta kõik väljad">
                        </form>
                    </div>
                   
                </div>
                <div class="col-sm-8" id="searchRightCol">

                <?php 
                
                    foreach($tutorData as $key):
                
                ?>
                    <div id="block" class="viewItems row <?php echo "viewId_".$key['id'] ?>">
                        <div class="col-4 viewItemsImageCol" style="padding-left:0px;">
                            <img src="upload/<?php echo $key['image'];?>" height=200 width=100% id="viewItemImage">
                        </div>
                        <div class="col-8">
                            <div class="row viewItemsRight">
                                <h5 id="viewName"><?php echo $key['firstname']." ".$key['surname'];?><h5> 
                            </div>
                            <div class="row viewItemsRight">
                                <p id="tutorDescription"><?php echo $key['biography'];?><p>
                            </div>
                            <div class="row viewItemsRight">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="Images/eurIcon.svg" height=30 width=30>
                                        </div>
                                        <div class="col-10">
                                            <p id="ViewItems"><?php echo $key['hourly_pay'];?> EUR/t</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="Images/translateIcon.svg" height=30 width=30>
                                        </div>
                                        <div class="col-10 ">
                                            <p id=""><?php echo $key['language'];?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>

                <script>
                    $(".viewId_<?php echo $key['id']; ?>").click(function(){
                        window.location = "tutorDescribe.php?getTutorId=<?php echo $key['id']; ?>";
                    });
                
                </script>

                <?php 
                
                    endforeach;

                ?>
                <script>
                    $("#deleteAllValuesSearch").click(function(){

                        $("#townSearch").val("");

                        $('.selectpicker').selectpicker('deselectAll');

                        $("#studentCheck").prop('checked', false);
                        $("#tutorCheck").prop('checked', false);
                        $("#internetCheck").prop('checked', false);
                        
                    });

                    var ajax_load = "<img src='http://automobiles.honda.com/images/current-offers/small-loading.gif' alt='loading...' />";
                    
                    $("#submitSearch").click(function(){

                        var salaryStart = $("#salaryStart").val();
                        var salaryEnd = $("#salaryEnd").val();

                        var ageStart = $("#ageStart").val();
                        var ageEnd = $("#ageEnd").val();

                        var counties = $("#counties").val();

                        var townSearch = $("#townSearch").val();

                        if($("#studentCheck").is(':checked')){
                             var studentCheckSearch = $("#studentCheck").is(':checked'); 
                        }
                        if($("#tutorCheck").is(':checked')){
                            var tutorCheckSearch = $("#tutorCheck").is(':checked'); 
                        }
                        if($("#internetCheck").is(':checked')){
                            var internetCheckSearch = $("#internetCheck").is(':checked'); 
                        }

                        var selectSubject = $("#selectSubject").val();
                        var selectLanguage = $("#selectLanguage").val();
                        var selectEducation = $("#selectEducation").val();

                        var loadUrl = "listView.php";
                        var data = {
                            salaryStart:salaryStart,
                            salaryEnd:salaryEnd,
                            ageStart:ageStart,
                            ageEnd:ageEnd,
                            counties:counties,
                            townSearch:townSearch,
                            studentCheckSearch:studentCheckSearch,
                            tutorCheckSearch:tutorCheckSearch,
                            internetCheckSearch:internetCheckSearch,
                            selectSubject:selectSubject,
                            selectLanguage:selectLanguage,
                            selectEducation:selectEducation
                        };
                        $('#searchRightCol').html(ajax_load);
                        $.ajax({
                            url: loadUrl,
                            cache: false,
                            type: "GET",
                            data: data,
                            dataType: "HTML",
                            success: function(result){
                                 $('#searchRightCol').html(result);
                            },
                            error:function(error){
                                console.log('Error ${error}');
                            }
                        });
                    });
                </script>
                </div>
            </div>
            <!-- siin lõpeb lehe custom html -->
            <div id="footer"></div> 
        </div>
    </body>
    <!-- Own JavaScript --> 
    <script src="scripts/onDocumentReady.js"></script> 
    <script src="scripts/sizeDetector.js"></script>

     <!-- CDN Bootstrap-select -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  
    <!-- CDN Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 </html>