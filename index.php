<?php
include("wc/header.html");
include("wc/navbar.html");?>

<div id="g_id_onload"
         data-client_id="53470530043-5gvhfeap2r8e2vjdjbjl82q22u75pq5k.apps.googleusercontent.com"
         data-callback="handleCredentialResponse">
    </div>
    
    <div class="g_id_signin"></div>

    <div id="profile-info">
        <h2>Welcome!</h2>
        <p>Name: <span id="profile-name"></span></p>
        <p>Email: <span id="profile-email"></span></p>
        <img id="profile-picture" alt="Profile Picture" width="100">
        <br>
        <button onclick="signOut()">Sign Out</button>
    </div>

    <script src="main.js"></script>

<?php       
include("wc/work.html");
include("wc/footer.html");?>