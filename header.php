<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Blog</title>
	<style>
		body {
			padding: 0;
			margin: 0;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;
			-webkit-flex-direction: column;
			-moz-flex-direction: column;
			-ms-flex-direction: column;
			-o-flex-direction: column;
			flex-direction: column;
			justify-content: space-between;
			height: 100vh;
		}

		header, footer {
			padding: 18px;
		}

		header {
			background-color: rgba(0, 0, 0, .1);
		}
	
		footer {
			color: #fff;
			background-color: rgba(0, 0, 0, .9);
		}

		.container {
			width: 1140px;
			margin: auto;
		}

		.error {
			color: red;
		}

		.post {
			width: 100%;
			border: 1px solid lightgrey;
			margin-bottom: 30px;
			padding: 18px;
		}

		.post * {
			margin-bottom: 10px;
		}

		.post *:last-child {
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<header>
		<h3>Header</h3>
		<nav>
			<?php if(!isset($_SESSION['firstname'])) { ?>
				<a href="login.php">Login</a>
				|
				<a href="register.php">Register</a>
			<?php } ?>

			<?php if(isset($_SESSION['firstname'])) { ?>
				<a href="logout.php">Logout</a>
			<?php } ?>
		</nav>
	</header>
	<div class="container">