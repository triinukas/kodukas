<?php 
    $tutorData = array();

    include 'connectDB.php';

    $theQuery = "";
    $counties = "";
    $selectLanguage = "";
    // if(!empty($_GET["salaryStart"]) && !empty($_GET["salaryEnd"])){
               
    // }
    // if(!empty($_GET["ageStart"]) && !empty($_GET["ageEnd"])){
               
    // }
    if(!empty($_GET["counties"])){
        foreach($_GET["counties"] as $key){
            $theQuery .= "SELECT * FROM tutor WHERE counties REGEXP '(^".$key."[,]+|[,]".$key."[,])';";
        }
    }
    if(!empty($_GET["townSearch"])){
        $townSearch = $_GET["townSearch"];
        $townSearch = str_replace(' ', '', $townSearch);
        $theQuery .= "SELECT * FROM tutor WHERE town REGEXP '(^".$townSearch."[,]+|[,]".$townSearch."[,])';";

    }
    if(!empty($_GET["studentCheckSearch"])){
        $theQuery .= "SELECT * FROM tutor WHERE at_the_student = '1';";
    }
    if(!empty($_GET["tutorCheckSearch"])){
        $theQuery .= "SELECT * FROM tutor WHERE at_the_teacher = '1';";
    }
    if(!empty($_GET["internetCheckSearch"])){
        $theQuery .= "SELECT * FROM tutor WHERE through_the_Internet = '1';";

    }
    if(!empty($_GET["selectSubject"])){
        foreach($_GET["selectSubject"] as $key){
            $theQuery .= "SELECT * FROM tutor WHERE subject REGEXP '(^".$key."[,]+|[,]".$key."[,])';";
        }
    }
    if(!empty($_GET["selectLanguage"])){
        foreach($_GET["selectLanguage"] as $key){
            $theQuery .= "SELECT * FROM tutor WHERE language REGEXP '(^".$key."[,]+|[,]".$key."[,])';";
        }
    }
    if(!empty($_GET["selectEducation"])){
        foreach($_GET["selectEducation"] as $key){
            $theQuery .= "SELECT * FROM tutor WHERE education = '".$key."';";
        }
    }
    if($theQuery == ""){
        $theQuery = "SELECT * FROM tutor;";
    }
    

    if (mysqli_multi_query($conn,$theQuery))
    {
        do
        {
            // Store first result set
            if ($result=mysqli_store_result($conn))
            {
                // Fetch one and one row
                while($row = $result->fetch_assoc()) {
                    $tutorData[] = $row;
                }
                // Free result set
                mysqli_free_result($result);
            }
        }
        while (mysqli_next_result($conn));
    }
    foreach($tutorData as $key => $value){
        
    }
    // echo '<br><br>';
    // echo '<br>BEFORE<br>';
    // print_r($tutorData);

    $isDuplicate = false;
    foreach ($tutorData as $current_key => $current_array) {
        // echo "current key: $current_key\n";
        foreach ($tutorData as $search_key => $search_array) {
            if ($search_array['user_id'] == $current_array['user_id']) {
                if ($search_key != $current_key) {
                    $isDuplicate = true;
                    // echo "duplicate found: $search_key\n";
                }
            }
           
        } 
        if($isDuplicate){
            unset($tutorData[$current_key]);
            $isDuplicate = false;
        }
        // echo "\n";
    }
    // echo '<br><br>';
    // echo '<br>AFTER<br>'; echo '<br><br>';
    // echo '<br><br>';    

    // print_r($tutorData);
    // $result = $conn->query($theQuery);
    // if($result->num_rows > 0) { 
                    
    //     while($row = $result->fetch_assoc()) {
    //         $tutorData[] = $row;
    //     }
    //     // deleting "," if last char
    //     for($i = 0; $i < count($tutorData); $i++){
    //         foreach ($tutorData[$i] as $key => $value) {
    //             if(substr($value, -1) == ","){
    //                 $tutorData[$i][$key] = substr_replace($tutorData[$i][$key], "", -1);
    //                 // echo $tutorData[$i][$key];
    //             }
    //         }
    //     }
        
    // } else {
    //     exit("Some error");
    // }
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
    </body>
</html>
