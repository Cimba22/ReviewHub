<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('categories', 'CategoryController');
Routing::get('reviews', 'ReviewController');
Routing::get('reviewDetails', 'ReviewController');
Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('registration', 'SecurityController');


Routing::post('add', 'ReviewController');
Routing::post('delete', 'ReviewController');
Routing::get('update', 'ReviewController');
Routing::post('update', 'ReviewController');





Routing::run($path);
