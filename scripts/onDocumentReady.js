$(document).ready(function(){
    if($(window).width() < 445){
        document.getElementById("MainCaption").style.display = "none";
        document.getElementById("HelpCaption").style.display = "block";
    }
    else{
        document.getElementById("MainCaption").style.display = "block";
        document.getElementById("HelpCaption").style.display = "none";
    }

    $("#header").load("header.php");
    $("#footer").load("footer.php"); 
}); 