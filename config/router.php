<?php

// tradiotional method for getting page routes
// Link: http://localhost/project/index.php?p=dashboard
// $p = $_GET['p'];
// if($p == 'dashboard') require('views/pages/dashboard.php');
// if($p == 'account') require('views/pages/account.php');

$uri = explode('/', $_SERVER['REQUEST_URI']);
$route = $uri[array_key_last($uri)];

$routes = [
    'dashboard' => 'views/pages/dashboard',
    'account' => 'views/pages/account',
    
];

// $router->get('/account', function(){});
// $router->get('/account', [AccountController::class, 'index']);

require($routes[$route]);
