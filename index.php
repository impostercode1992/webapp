<?php include("wc/header.html");?>
      <script src="script.js"></script>
      <script>
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
      </script>
    </head>
    <body onload="initOnLoad()">
        <div id="myAccount">
                        <div class="signInGoogleWrapper">
                          <a href="https://www.norsats.my/oauth-service/sign-in.php?site=norsats&page=index.php">kkk</a>
                        <span>Continue with Google</span>

            </div>
        </div>     
<?php // include("wc/navbar.html");?>

        </div>

          <?php include("wc/login.html");?>
      
      </header>
<?php include("wc/footer.html");?>
