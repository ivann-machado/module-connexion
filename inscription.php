<?php
session_start();
require_once 'func.php';
if (!isset($_POST)) {
	header("Location: ./index.php");
	exit();
}
//registration controller, use the functions from func.php, errors are handled there, just try catch errors message, form validation is done in func.php, don't use functions that are not in func.php

//user array should have the following keys: login, password, pwc, prenom, nom but not all are required

$user = [
	'login' => isset($_POST['login']) ? $_POST['login'] : '',
	'password' => isset($_POST['password']) ? $_POST['password'] : '',
	'pwc' => isset($_POST['pwc']) ? $_POST['pwc'] : '',
	'prenom' => isset($_POST['prenom']) ? $_POST['prenom'] : '',
	'nom' => isset($_POST['nom']) ? $_POST['nom'] : ''
];

try {
	createUser(getDB(), $user);
	header("Location: ./index.php?success=1#login");
	exit();
} catch (Exception $e) {
	// Redirect back to the registration page with an error message
	$_SESSION['error'] = $e->getMessage();
	header("Location: ./index.php?error=1#signin");
	exit();
}

?>