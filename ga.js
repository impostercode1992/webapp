var YOUR_CLIENT_ID =
  "53470530043-5gvhfeap2r8e2vjdjbjl82q22u75pq5k.apps.googleusercontent.com";
var YOUR_REDIRECT_URI = "https://www.norsats.my/user";

// Parse query string to see if page request is coming from OAuth 2.0 server.
var fragmentString = location.hash.substring(1);
var params = {};
var regex = /([^&=]+)=([^&]*)/g,
  m;
while ((m = regex.exec(fragmentString))) {
  params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
}
if (Object.keys(params).length > 0 && params["state"]) {
  if (params["state"] == localStorage.getItem("state")) {
    localStorage.setItem("oauth2-test-params", JSON.stringify(params));

    trySampleRequest();
  } else {
    console.log("State mismatch. Possible CSRF attack");
  }
}

// Function to generate a random state value
function generateCryptoRandomState() {
  const randomValues = new Uint32Array(2);
  window.crypto.getRandomValues(randomValues);

  // Encode as UTF-8
  const utf8Encoder = new TextEncoder();
  const utf8Array = utf8Encoder.encode(
    String.fromCharCode.apply(null, randomValues)
  );

  // Base64 encode the UTF-8 data
  return btoa(String.fromCharCode.apply(null, utf8Array))
    .replace(/\+/g, "-")
    .replace(/\//g, "_")
    .replace(/=+$/, "");
}

// If there's an access token, try an API request.
// Otherwise, start OAuth 2.0 flow.
function trySampleRequest() {
  var params = JSON.parse(localStorage.getItem("oauth2-test-params"));
  if (params && params["access_token"]) {
    // User authorized the request. Now, check which scopes were granted.
    if (
      params["scope"].includes(
        "https://www.googleapis.com/auth/drive.metadata.readonly"
      )
    ) {
      // User authorized read-only Drive activity permission.
      // Calling the APIs, etc.
      var xhr = new XMLHttpRequest();
      xhr.open(
        "GET",
        "https://www.googleapis.com/drive/v3/about?fields=user&" +
          "access_token=" +
          params["access_token"]
      );
      xhr.onreadystatechange = function (e) {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(xhr.response);
        } else if (xhr.readyState === 4 && xhr.status === 401) {
          // Token invalid, so prompt for user permission.
          oauth2SignIn();
        }
      };
      xhr.send(null);
    } else {
      // User didn't authorize read-only Drive activity permission.
      // Update UX and application accordingly
      console.log(
        "User did not authorize read-only Drive activity permission."
      );
    }

    // Check if user authorized Calendar read permission.
    if (
      params["scope"].includes(
        "https://www.googleapis.com/auth/calendar.readonly"
      )
    ) {
      // User authorized Calendar read permission.
      // Calling the APIs, etc.
      console.log("User authorized Calendar read permission.");
    } else {
      // User didn't authorize Calendar read permission.
      // Update UX and application accordingly
      console.log("User did not authorize Calendar read permission.");
    }
  } else {
    oauth2SignIn();
  }
}

/*
 * Create form to request access token from Google's OAuth 2.0 server.
 */
function oauth2SignIn() {
  // create random state value and store in local storage
  var state = generateCryptoRandomState();
  localStorage.setItem("state", state);

  // Google's OAuth 2.0 endpoint for requesting an access token
  var oauth2Endpoint = "https://accounts.google.com/o/oauth2/v2/auth";

  // Create element to open OAuth 2.0 endpoint in new window.
  var form = document.createElement("form");
  form.setAttribute("method", "GET"); // Send as a GET request.
  form.setAttribute("action", oauth2Endpoint);

  // Parameters to pass to OAuth 2.0 endpoint.
  var params = {
    client_id: YOUR_CLIENT_ID,
    redirect_uri: YOUR_REDIRECT_URI,
    scope:
      "https://www.googleapis.com/auth/drive.metadata.readonly https://www.googleapis.com/auth/calendar.readonly",
    state: state,
    include_granted_scopes: "true",
    response_type: "token",
  };

  // Add form parameters as hidden input values.
  for (var p in params) {
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", p);
    input.setAttribute("value", params[p]);
    form.appendChild(input);
  }

  // Add form to page and submit it to open the OAuth 2.0 endpoint.
  document.body.appendChild(form);
  form.submit();
}

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

// Function to check for token and redirect if necessary
function checkAuthAndLoadContent() {
  const token = localStorage.getItem("authToken"); // Or retrieve from cookie

  if (token) {
    // Optionally, send token to backend for full validation
    // If valid, load protected content
    console.log(
      "Token found and potentially valid. Loading protected content."
    );
    // Example: Show protected content div
    document.getElementById("protected-content").style.display = "block";
  } else {
    console.log("No token found. Redirecting to login page.");
    // Example: Redirect to login page
    window.location.href = "/index";
  }
}

// Get the modal
var modal = document.getElementById("id01");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
