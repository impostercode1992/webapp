<?php
session_start();
$_SESSION['site'] = $_GET['site'];
$_SESSION['returnPage'] = $_GET['page'];
?>

<html>
    <head>
        <style>
            body {
            font-size: 12px;
            font-family: verdana;
            }            

            header {
                text-align: center;
                font-weight: bold;
            }

            header > div {
                height: 50px;
            }

            #signInPanel {
                display: flex;
                flex-direction: column;
                margin: 0px auto 24px;
                width: 400px;
                padding: 32px 40px;
                background: rgb(255, 255, 255);
                border-radius: 3px;
                box-shadow: rgb(0 0 0 / 10%) 0px 0px 10px;
                box-sizing: border-box;
                color: rgb(94, 108, 132);
            }

            #apple-auth-button, #google-auth-button {
                webkit-box-align: baseline;
                align-items: baseline;
                border-width: 0px;
                border-radius: 3px;
                box-sizing: border-box;
                display: inline-flex;
                font-size: inherit;
                font-style: normal;
                font-family: inherit;
                max-width: 100%;
                position: relative;
                text-align: center;
                text-decoration: none;
                transition: background 0.1s ease-out 0s, box-shadow 0.15s cubic-bezier(0.47, 0.03, 0.49, 1.38) 0s;
                white-space: nowrap;
                cursor: pointer;
                padding: 0px 10px;
                vertical-align: middle;
                width: 100%;
                -webkit-box-pack: center;
                justify-content: center;
                font-weight: bold;
                color: var(--ds-text,#42526E) !important;
                height: 40px !important;
                line-height: 40px !important;
                background: rgb(255, 255, 255) !important;
                box-shadow:  rgb(0 0 0 / 20%) 1px 1px 5px 0px !important           
            }

            #apple-auth-button > img, #google-auth-button > img {
                width:20px;
                height: 20px;
                position: relative;
                top: 3px;
                padding-right: 20px;                
            }
        </style>

    </head>
    <body>
        <header>
            <div></div>
            SIGN IN SERVICE
            <div></div>
        </header>
        <div id="signInPanel">
            <!-- Sign-In with Apple -->
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
                    <input type="hidden" id="client_id" name="client_id" value="53470530043-5gvhfeap2r8e2vjdjbjl82q22u75pq5k.apps.googleusercontent.com" />
                    <input type="hidden" id="redirect_uri" name="redirect_uri" value="https://www.norsats.my/oauth-service/callbacks/callback.php?provider=google" />
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
