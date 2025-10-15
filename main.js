// This function is the callback for the Google Sign-In button
function handleCredentialResponse(response) {
    // The credential contains the ID token as a JWT
    const idToken = response.credential;
    console.log("Encoded JWT ID token: " + idToken);

    // Decode the JWT to get user information
    const userProfile = decodeJwt(idToken);
    console.log("User Profile:", userProfile);

    // Display the user's profile information
    document.getElementById("profile-name").textContent = userProfile.name;
    document.getElementById("profile-email").textContent = userProfile.email;
    document.getElementById("profile-picture").src = userProfile.picture;
    
    // Hide the button and show the profile info
    document.querySelector(".g_id_signin").style.display = "none";
    document.getElementById("profile-info").style.display = "block";

    // You should send the ID token to your backend for verification
    // sendTokenToBackend(idToken);
}

// Function to decode a JWT
function decodeJwt(token) {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
    return JSON.parse(jsonPayload);
}

// Function to sign a user out
function signOut() {
    google.accounts.id.disableAutoSelect();
    document.querySelector(".g_id_signin").style.display = "block";
    document.getElementById("profile-info").style.display = "none";
    console.log("User signed out.");
}
