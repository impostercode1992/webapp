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
                <form action="https://accounts.google.com/o/oauth2/v2/auth" method="get">
                    <input type="hidden" id="client_id" name="client_id" value="53470530043-5gvhfeap2r8e2vjdjbjl82q22u75pq5k.apps.googleusercontent.com" />
                    <input type="hidden" id="redirect_uri" name="redirect_uri" value="https://wwww.norsats.my/oauth-service/callbacks/callback.php?provider=google" />
                    <input type="hidden" id="response_type" name="response_type" value="code"/>
                    <input type="hidden" id="scope" name="scope" value="openid email profile" />
                    <input type="hidden" id="state" name="state" value="123" />

                    <button id="google-auth-button" class="css-11s2kpt" type="submit" tabindex="0">
                        <img src="https://www.toni-develops.com/external-files/examples/assets/google-logo.svg" alt="Sign-in with Google">
                        <span>Continue with Google</span>
                    </button>
                </form>
            </div>
        </div>     
<?php // include("wc/navbar.html");?>

        </div>

          <?php include("wc/login.html");?>
      
      </header>
<?php include("wc/footer.html");?>
