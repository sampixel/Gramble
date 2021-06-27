<?php

/**
 * This file contains basic functionality for running the framework
 * Basically it provides routing access from the browser
 * 
 * @license	https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com>
 */

use App\Controller\Application;

require_once __DIR__ . "/../vendor/autoload.php";

$app = new Application;

$app->enable_errors(1);

$app->router->match("/", "get", function() {
	return "/../src/View/index.phtml";
});

$app->router->match("/profile", "get", function() {
	return "/../src/View/profile.phtml";
});

$app->run();