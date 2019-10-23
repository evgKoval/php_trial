<?php 
$routes = ['login.php', 'register.php', 'content.php', 'logout.php', '404.php'];
$uri = substr($_SERVER['REQUEST_URI'], 1);

foreach ($routes as $route) {
	if ($uri === $route) {
		require $route;
	}
}

