<?php
session_start();
define('ROOTPATH', __DIR__);

include  ROOTPATH ."/config/config.php";

$site = $_GET['site'];
$returnPage = $_GET['page'];
$baseUrl = $authCoinfig->sites->$site->baseUrl;

$page = $_GET['page'];
$returnUrl = $baseUrl . $page;

//die(">>>". $returnUrl);

unset($_SESSION['email']);
session_unset();
session_destroy();
// Redirect the user to the initial app 
header('Location: ' . $returnUrl);