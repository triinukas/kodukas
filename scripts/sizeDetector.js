var body = document.getElementsByTagName("Body")[0];
var width = body.offsetWidth;

if (window.addEventListener) {  // all browsers except IE before version 9
  window.addEventListener ("resize", onResizeEvent, true);
} else {
  if (window.attachEvent) {   // IE before version 9
    window.attachEvent("onresize", onResizeEvent);
  }
}

function onResizeEvent() {
  bodyElement = document.getElementsByTagName("BODY")[0];
  newWidth = bodyElement.offsetWidth;
  if(newWidth != width){
    width = newWidth;
    if(width < 445){
        document.getElementById("MainCaption").style.display = "none";
        document.getElementById("HelpCaption").style.display = "block";
    }
    else{
        document.getElementById("MainCaption").style.display = "block";
        document.getElementById("HelpCaption").style.display = "none";
    }
  }
} 