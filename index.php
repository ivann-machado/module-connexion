<?php
session_start();
require_once 'func.php';
// var_dump($_SESSION['error']);
if (isset($_GET['logout'])) {
	logout();
}


include 'views/head.php';

include 'views/main.php';

include 'views/foot.php';
if (isset($_SESSION['error'])) {
	session_unregister('error');
	unset($_SESSION['error']);
}
?>