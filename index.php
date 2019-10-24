<?php 
session_start();
$routes = ['login', 'register', 'content', 'logout', '404', 'create-post', 'edit', 'save-post', 'delete'];

$uri = substr($_SERVER['REQUEST_URI'], 1);
$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
$segments = explode('/', $internalRoute);

$isContent = false;

foreach ($routes as $route) {
    if ($segments[0] === $route || $uri === ($route . '.php')) {
    	$isContent = true;
        require $route . '.php';
    }
}

if (!$isContent) {
	require_once '404.php';
}

