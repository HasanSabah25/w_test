<?php

$uri = explode('/', $_SERVER['REQUEST_URI']);
$route = $uri[array_key_last($uri)];

$routes = [
    'dashboard' => './views/pages/dashboard.php',
    'account' => './views/pages/account.php',
];

if (isset($routes[$route])) {
    require($routes[$route]);
} else {
    header('Location: ' . dirname(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) . '/dashboard');
    exit;
}
