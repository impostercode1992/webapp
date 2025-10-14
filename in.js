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