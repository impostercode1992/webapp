
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




        function decodeJWT(token) {
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
        
        function handleCredentialResponse(response) {
        console.log("Encoded JWT ID token: " + response.credential);
        const responsePayload = decodeJWT(response.credential);
        console.log("Decoded JWT ID token fields:");
        console.log("  Full Name: " + responsePayload.name);
        console.log("  Given Name: " + responsePayload.given_name);
        console.log("  Family Name: " + responsePayload.family_name);
        console.log("  Unique ID: " + responsePayload.sub);
        console.log("  Profile image URL: " + responsePayload.picture);
        console.log("  Email: " + responsePayload.email);
        }