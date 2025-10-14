function setCookie(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}
function eraseCookie(name) {   
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function showModalPopUp()    
{
  popUpObj=window.open(
    "https://www.norsats.my/oauth-service/sign-in.php?site=norsats&page=index.php",
    "ModalPopUp",
    "toolbar=no," +
    "scrollbars=no," +
    "location=no," +
    "statusbar=no," +
    "menubar=no," +
    "resizable=0," +
    "width=500," +
    "height=640," +
    "left = 480," +
    "top=300"
  );

  popUpObj.focus();
}   


function sendDataToMainApp() {       
var userData = <?php echo json_encode($params); ?>;
window.opener.receiveUserSignedInData(userData);
window.close();
}

function receiveUserSignedInData(userData) {
document.querySelector("#myAccount").innerHTML = userData.email + ' (<a href="sign-out.php?site=norsats&page=index.php">log-out</a>)';
userDataStringifyed = JSON.stringify(userData);
setCookie('userData', userDataStringifyed, 5);
console.dir(userData, { depth: null });
}

function initOnLoad() {
var userDataString = getCookie('userData');
if(userDataString !== null) {
userData = JSON.parse(userDataString);
document.querySelector("#myAccount").innerHTML = userData.email + ' (<a href="sign-out.php?site=norsats&page=index.php">log-out</a>)';
}
}    