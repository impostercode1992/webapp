<?php
session_start();
$_SESSION['site'] = $_GET['site'];
$_SESSION['returnPage'] = $_GET['page'];
?>

<html>
    <head>
    </head>
    <body>
        <header>
            <div></div>
            SIGN IN SERVICE
            <div></div>
        </header>
        <div id="signInPanel">
            <!-- Sign-In with Apple >
            <div class="signInAppleWrapper">
                <form action="https://appleid.apple.com/auth/authorize?" method="get">
                    <input type="hidden" id="client_id" name="client_id" value="com.toni-develops.public.oauth-with-all-providers-service" />
                    <input type="hidden" id="redirect_uri" name="redirect_uri" value="https://public.toni-develops.com/examples/oauth/oauth-service/callbacks/callback.php?provider=apple" />
                    <input type="hidden" id="response_type" name="response_type" value="code id_token"/>
                    <input type="hidden" id="scope" name="scope" value="name email" />
                    <input type="hidden" id="response_mode" name="response_mode" value="form_post" />

                    <button id="apple-auth-button" type="submit" tabindex="0">
                        <img class="appleLogo" src="https://www.toni-develops.com/external-files/examples/assets/apple-logo.svg" alt="">
                        <span>Continue with Apple</span>
                    </button>
                </form>
            </div>


            <!-- Sign-In with Google -->
            <div class="signInGoogleWrapper">
                <form action="https://accounts.google.com/o/oauth2/v2/auth" method="get">
                    <input type="hidden" id="client_id" name="client_id" value="989056576533-mtef8cl5is5ogjh3np580ireurns7l5k.apps.googleusercontent.com" />
                    <input type="hidden" id="redirect_uri" name="redirect_uri" value="https://public.toni-develops.com/examples/oauth/oauth-service/callbacks/callback.php?provider=google" />
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



    </body>
</html>

