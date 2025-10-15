
  function countCharacters() {
  const textarea = document.getElementById("textInput");
  const charCountSpan = document.getElementById("charCount");
  const maxLength = 200; // Define your desired maximum length

  const currentLength = textarea.value.length;
  const charactersLeft = maxLength - currentLength;

  charCountSpan.textContent = currentLength;

  // Optional: Add styling based on character count
  if (currentLength > 180) {
    charCountSpan.style.color = "red";
  } else {
    charCountSpan.style.color = "black";
  }
}

// Initialize the count on page load
window.onload = countCharacters;

window.onload = onSignIn;

                function handleCredentialResponse(response) {
                        // Decode the JWT credential
                        const responsePayload = decodeJwtResponse(response.credential);
                        console.log("ID: " + responsePayload.sub);
                        console.log('Full Name: ' + responsePayload.name);
                        console.log('Given Name: ' + responsePayload.given_name);
                        console.log('Family Name: ' + responsePayload.family_name);
                        console.log("Image URL: " + responsePayload.picture);
                        console.log("Email: " + responsePayload.email);

                        // You would typically send this credential to your backend for verification
                        // and user session management.
                }

                function decodeJwtResponse(token) {
                        var base64Url = token.split('.')[1];
                        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function (c) {
                                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                        }).join(''));
                        return JSON.parse(jsonPayload);
                }
                // This function runs after a user successfully signs in
                function onSignIn(googleUser) {
                        // Check if a user is signed in
                        if (auth2.isSignedIn.get()) {
                                // Get the user's BasicProfile object
                                var profile = googleUser.getBasicProfile();

                                // Call the methods to get the user's data
                                var userId = profile.getId();
                                var fullName = profile.getName();
                                var givenName = profile.getGivenName();
                                var familyName = profile.getFamilyName();
                                var imageUrl = profile.getImageUrl();
                                var email = profile.getEmail();

                                // Log the information to the console
                                console.log('ID: ' + userId);
                                console.log('Full Name: ' + fullName);
                                console.log('Given Name: ' + givenName);
                                console.log('Family Name: ' + familyName);
                                console.log('Image URL: ' + imageUrl);
                                console.log('Email: ' + email);

                                // Update your webpage with the user's information
                                document.getElementById('profile-name').textContent = fullName;
                                document.getElementById('profile-email').textContent = email;
                                document.getElementById('profile-image').src = imageUrl;
                        }
                }