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
  document.getElementById("profile-name").innerText = responsePayload.name;
  document.getElementById("profile-email").innerText = responsePayload.email;
  document.getElementById("profile-pic").src = responsePayload.picture;

  // Hide the sign-in button and show the profile card
  document.querySelector(".g_id_signin").style.display = "none";
  document.getElementById("profile-container").style.display = "block";
}

// Helper function to decode the JWT token
function decodeJwtResponse(token) {
  let base64Url = token.split(".")[1];
  let base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
  let jsonPayload = decodeURIComponent(
    atob(base64)
      .split("")
      .map(function (c) {
        return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
      })
      .join("")
  );
  return JSON.parse(jsonPayload);
}

// Function to sign out the user
function signOut() {
  // Use Google's API to sign out
  google.accounts.id.disableAutoSelect(); // Prevents One Tap from re-displaying immediately

  // Reset the UI
  document.querySelector(".g_id_signin").style.display = "block";
  document.getElementById("profile-container").style.display = "none";
}
