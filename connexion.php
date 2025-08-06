<?php
session_start();
require_once 'func.php';
if (!isset($_POST) || isset($_SESSION['user'])) {
	header("Location: ./");
	exit();
}
else {
	$user = [
		'login' => isset($_POST['login']) ? $_POST['login'] : '',
		'password' => isset($_POST['password']) ? $_POST['password'] : '',
	];
	try {
		$_SESSION['user'] = connectUser(getDB(), $user);
		header("Location: ./");
		exit();
	} catch (Exception $e) {
		$_SESSION['error'] = $e->getMessage();
		header("Location: ./?error=1#login");
		exit();
	}
}
?>