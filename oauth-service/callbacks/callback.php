<?php
session_start();
define('ROOTPATH', __DIR__ .'/..');
include "../config/config.php";

$provider = $_GET['provider'];

if(!array_key_exists('site', $_SESSION)) {
  print_r($_SESSION);
  die("missing session 'site' key");
}
$site = $_SESSION['site'];
$returnPage = $_SESSION['returnPage'];
$authMethod = $authCoinfig->sites->$site->authenticationMethod;
$baseUrl = $authCoinfig->sites->$site->baseUrl;


// die(">>". "./callback-" . $provider . '.php');
include "./callback-" . $provider . '.php';
