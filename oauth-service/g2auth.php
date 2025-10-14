<?php
// add Google app config params
include 'config/gconfig.php';

// ####################################################
// Step 2: When Google redirects the user back here, 
// there will be a "code" and "state"
// parameter in the query string
// Exchange the auth code for a JWT token,
// and extract requested user data from there
// ####################################################
if(isset($_GET['code'])) {
  
  // Verify the state matches our stored state
  if(!$_GET['state'] && $_GET['state'] !== '123') {    
    die('missing state!');
  }
  
function exchangeCodeForJWToken($code, $tokenURL, $googleClientID, $googleClientSecret, $redirectURL) {
  // Exchange the auth code for a token
  $ch = curl_init($tokenURL);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'grant_type' => 'authorization_code',
    'client_id' => $googleClientID,
    'client_secret' => $googleClientSecret,
    'redirect_uri' => $redirectURL,
    'code' => $code
  ]));  


  $response = curl_exec($ch);

  // $data will contain 
  // access_token, 
  // expires_in, 
  // scope, 
  // token_type, 
  // id_token - which is JWT token, containing user data according to requested scope from the initial script.
  $data = json_decode($response, true);
  //echo '<pre>';print_r($data);die("</pre>");

  // Note: You'd probably want to use a real JWT library
  // but this will do in a pinch. This is only safe to do
  // because the ID token came from the https connection
  // from Google rather than an untrusted browser redirect

  // Split the JWT string into three parts
  $jwt = explode('.', $data['id_token']);

  // Extract the middle part, base64 decode it, then json_decode it
  $IDToken = json_decode(base64_decode($jwt[1]), true);
  
  // This step is required only if we want to get extra info
  /*
  $ch = curl_init($usserInfoURL);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer '.$data['access_token']
  ]);
  $userInfo = curl_exec($ch);
  */
  /*
  echo '<h1>Token ID</h1>';
  echo '<pre>';print_r($IDToken);echo '</pre>';
  echo '<h1>User info</h1>';
  echo '<pre>';print_r($userInfo);die('</pre>');
  */

$userData = exchangeCodeForJWToken($_GET['code'], $tokenURL, $googleClientID, $googleClientSecret, $redirectURL);


// prepare parameters to pass back to the main app
$params = array(
  'email'       => $userData['email'],
  'name'        => $userData['name'],
  'given_name'  => $userData['given_name'],
  'family_name' => $userData['family_name'],
  'returnPage'  => $returnPage
);

$returnUrl = $baseUrl . $returnPage;

if($authMethod === "redirect") {
  // Redirect the user to the initial app passing user data as Query String parameters so the front end could use them.
  header('Location: ' . $returnUrl . '?' . http_build_query($params));
} else if($authMethod === "popupRedirect") {
  include '../sign-in-popup.php';
}