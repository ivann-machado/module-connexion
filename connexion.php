<?php
session_start();
require_once 'func.php';
if (!isset($_POST) || isset($_SESSION['user'])) {
	header("Location: ./index.php");
	exit();
}
else {
	$user = [
		'login' => isset($_POST['login']) ? $_POST['login'] : '',
		'password' => isset($_POST['password']) ? $_POST['password'] : '',
	];
	try {
		$_SESSION['user'] = connectUser(getDB(), $user);
		header("Location: ./index.php");
		exit();
	} catch (Exception $e) {
		$_SESSION['error'] = $e->getMessage();
		header("Location: ./index.php?error=1#login");
		exit();
	}
}
?>