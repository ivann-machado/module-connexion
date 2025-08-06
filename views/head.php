<!DOCTYPE HTML>
<html>
<head>
	<title>Module Connexion</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="./public/assets/css/main.css" />
	<noscript><link rel="stylesheet" href="./public/assets/css/noscript.css" /></noscript>
	<script src="./public/assets/js/jquery.min.js" defer></script>
	<script src="./public/assets/js/browser.min.js" defer></script>
	<script src="./public/assets/js/breakpoints.min.js" defer></script>
	<script src="./public/assets/js/util.js" defer></script>
	<script src="./public/assets/js/main.js"defer></script>
	<script src="https://kit.fontawesome.com/962132aee2.js" crossorigin="anonymous"></script>
</head>
<body class="is-preload">

	<!-- Wrapper-->
	<div id="wrapper">

		<!-- Nav -->
		<nav id="nav">
			<a href="#" class="icon solid fa-home"><span>Home</span></a>
			<?php if (isset($_SESSION['user']) && $_SESSION['user']['admin']): ?>
			<a href="#userlist" class="icon solid fa-circle-user"><span>Utilisateurs</span></a>
			<?php endif; ?>
			<?php if (isset($_SESSION['user'])): ?>
			<a href="#profil" class="icon solid fa-user"><span>Profil</span></a>
			<a href="./?logout" class="icon solid fa-arrow-right-from-bracket"><span>Logout</span></a>
			<?php else: ?>
			<a href="#login" class="icon solid fa-arrow-right-to-bracket"><span>Se connecter</span></a>
			<a href="#register" class="icon solid fa-feather-pointed"><span>Inscription</span></a>
			<?php endif; ?>
		</nav>
		<div id="main">