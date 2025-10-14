<?php
// add Google app config params
include 'config/gconfig.php';
session_start();
$_SESSION['site'] = $_GET['site'];
$_SESSION['returnPage'] = $_GET['page'];

// Start a session so we have session id to make sure that the redicect is instantiated by this script
$sessionId = '123';

// ####################################################
// STEP 1: Start the login process by sending the user
// to Google's authorization page, 
// and passing app params
// ####################################################


  // Generate a random hash and store in the session to make sure that 
  //$_SESSION['state'] = bin2hex(random_bytes(16));

  $params = array(
    'response_type' => 'code',
    'client_id'     => $googleClientID,
    'redirect_uri'  => $baseURL,
    'scope'         => 'openid email profile',
    'state'         => $sessionId
  );

  // Redirect the user to Google's authorization page, passing the above parameters as a GET request
  header('Location: ' . $authorizeURL . '?' . http_build_query($params));
