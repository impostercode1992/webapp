<?php
include("wc/header.html");
include("wc/navbar.html");?>
       <!-- Configuration for Google Identity Services -->
        <div id="g_id_onload" data-client_id="53470530043-5gvhfeap2r8e2vjdjbjl82q22u75pq5k.apps.googleusercontent.com"
                data-callback="handleCredentialResponse">
        </div>

        <!-- The Sign In With Google button -->
        <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with"
                data-shape="rectangular" data-logo_alignment="left">
        </div>
        <a href="#" onclick="signOut();">Sign out</a>
        <div id="user-profile">
                <h2 id="profile-name">metch</h2>
                <p id="profile-email">sodapop</p>
        </div>
 <?php       
include("wc/work.html");
include("wc/footer.html");?>