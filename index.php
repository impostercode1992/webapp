<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Sign-In Example</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .profile-card { display: none; margin-top: 20px; text-align: left; }
        .profile-card img { border-radius: 50%; margin-right: 15px; }
        .profile-card p { margin: 5px 0; }
        .hide { display: none; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Google Sign-In</h1>

        <!-- The Google Sign-In button container -->
        <div id="g_id_onload"
             data-client_id="YOUR_GOOGLE_CLIENT_ID"
             data-callback="handleCredentialResponse"
             data-auto_prompt="false">
        </div>
        <div class="g_id_signin"
             data-type="standard"
             data-size="large"
             data-theme="outline"
             data-text="signin_with"
             data-shape="rectangular"
             data-logo_alignment="left">
        </div>

        <!-- User profile information -->
        <div id="profile-container" class="profile-card">
            <h2>Welcome!</h2>
            <div style="display: flex; align-items: center;">
                <img id="profile-pic" src="" alt="Profile Picture" width="80" height="80">
                <div>
                    <p><strong>Name:</strong> <span id="profile-name"></span></p>
                    <p><strong>Email:</strong> <span id="profile-email"></span></p>
                </div>
            </div>
            <br>
            <button onclick="signOut()">Sign Out</button>
        </div>

    </div>

    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    
    <script>
        // Callback function for handling the Google credential response
        function handleCredentialResponse(response) {
            // Decode the JWT token to get user data
            const responsePayload = decodeJwtResponse(response.credential);
            
            // Log the payload to the console for inspection
            console.log("ID: " + responsePayload.sub);
            console.log("Full Name: " + responsePayload.name);
            console.log("Image URL: " + responsePayload.picture);
            console.log("Email: " + responsePayload.email);

            // Display the user profile
            document.getElementById('profile-name').innerText = responsePayload.name;
            document.getElementById('profile-email').innerText = responsePayload.email;
            document.getElementById('profile-pic').src = responsePayload.picture;
            
            // Hide the sign-in button and show the profile card
            document.querySelector('.g_id_signin').style.display = 'none';
            document.getElementById('profile-container').style.display = 'block';
        }

        // Helper function to decode the JWT token
        function decodeJwtResponse(token) {
            let base64Url = token.split('.')[1];
            let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
            return JSON.parse(jsonPayload);
        }

        // Function to sign out the user
        function signOut() {
            // Use Google's API to sign out
            google.accounts.id.disableAutoSelect(); // Prevents One Tap from re-displaying immediately
            
            // Reset the UI
            document.querySelector('.g_id_signin').style.display = 'block';
            document.getElementById('profile-container').style.display = 'none';
        }
    </script>

</body>
</html>
