<?php

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

  // Note: Ywe shoudl use real JWT library
  // Split the JWT string into three parts
  $jwt = explode('.', $data['id_token']);

  // Extract the middle part, base64 decode it, then json_decode it
  $IDToken = json_decode(base64_decode($jwt[1]), true);
  return $IDToken;  
}