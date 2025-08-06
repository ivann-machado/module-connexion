<?php
session_start();
require_once 'func.php';
// var_dump($_SESSION['dump']);
if (isset($_GET['logout'])) {
	logout();
}


include 'views/head.php';

include 'views/main.php';
if (isset($_SESSION['user']) && $_SESSION['user']['admin']) {
	include 'views/admin.php';
}
if (isset($_SESSION['user'])) {
	include 'views/profil.php';
}
else {
	include 'views/signin.php';
	include 'views/register.php';
}
include 'views/foot.php';
if (isset($_SESSION['error'])) {
	unset($_SESSION['error']);
}
?>