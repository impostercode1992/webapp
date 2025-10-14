<?php

include '../config/google-config.php';
include '../lib/google-lib.php';

if(!isset($_GET['code'])) { 
  die("Missing `code` in GET response !"); 
}


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