<?php 
session_start();
require_once 'func.php';
if (!isset($_POST) || !isset($_SESSION['user'])) {
	header("Location: ./index.php");
	exit();
}
$user = [
	'id' => $_SESSION['user']['id'],
	'login' => isset($_POST['login']) ? $_POST['login'] : $_SESSION['user']['login'],
	'prenom' => isset($_POST['prenom']) ? $_POST['prenom'] : $_SESSION['user']['prenom'],
	'nom' => isset($_POST['nom']) ? $_POST['nom'] : $_SESSION['user']['nom'],
	'password' => isset($_POST['password']) ? $_POST['password'] : $_SESSION['user']['password'],
	'pwc' => isset($_POST['pwc']) ? $_POST['pwc'] : '',
	'date' => $_SESSION['user']['date'],
	'admin' => isset($_SESSION['user']['admin']) ? $_SESSION['user']['admin'] : false
];
try {
	$_SESSION['user'] = updateUser(getDB(), $_SESSION['user'], $user);
	$_SESSION['success'] = 'Modification réussie !';
	header("Location: ./index.php?success=1#profil");
	exit();
} catch (Exception $e) {
	$_SESSION['error'] = $e->getMessage();
	header("Location: ./index.php?error=1#profil");
	exit();
}
?>