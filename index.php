<?php
//define abspath to make requiring and including easier.
define('ABS_PATH', __dir__);

require ABS_PATH . '/' . 'src/services/database.service.php';
require ABS_PATH . '/' . 'src/services/router.service.php';

$request = $_SERVER['REQUEST_URI'];
$db = DatabaseService::get_instance();
$router = RouterService::get_instance($db);
$router->dispatch($request);
