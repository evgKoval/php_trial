<?php 
session_start();
$routes = ['login', 'register', 'content', 'logout', '404', 'create-post', 'edit', 'save-post', 'delete', 'confirm'];

$uri = substr($_SERVER['REQUEST_URI'], 1);
$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
$segments = explode('/', $internalRoute);

$isContent = false;

if(strpos($segments[0], '?')) {
	$segments[0] = strstr($segments[0], '?', true);
}

foreach ($routes as $route) {
    if ($segments[0] === $route || $uri === ($route . '.php')) {
    	$isContent = true;
        require $route . '.php';
    }
}

if (!$isContent) {
	require_once '404.php';
}

