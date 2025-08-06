<?php
session_start();
require_once 'func.php';
if (!isset($_POST)) {
	header("Location: ./");
	exit();
}

$user = [
	'login' => isset($_POST['login']) ? $_POST['login'] : '',
	'password' => isset($_POST['password']) ? $_POST['password'] : '',
	'pwc' => isset($_POST['pwc']) ? $_POST['pwc'] : '',
	'prenom' => isset($_POST['prenom']) ? $_POST['prenom'] : '',
	'nom' => isset($_POST['nom']) ? $_POST['nom'] : ''
];

try {
	createUser(getDB(), $user);
	$_SESSION['success'] = 'Inscription réussie !';
	header("Location: ./?success=1#login");
	exit();
} catch (Exception $e) {
	$_SESSION['error'] = $e->getMessage();
	header("Location: ./?error=1#register");
	exit();
}
?>