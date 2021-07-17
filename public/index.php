<?php

/**
 * This file contains basic functionality for running the framework
 * 
 * @license	https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com>
 */

define("DIR", dirname(__DIR__));

require DIR . "/app/controllers/Application.php";

use app\controllers\Application;

$app = new Application(DIR);

$app->router->get("/", function() {
	$arrayData = [];
	return [DIR . "/src/views/home.php", $arrayData];
});

$app->router->get("/profile", function() {
	$arrayData = [];
	return [DIR . "/src/views/profile.php", $arrayData];
});

$app->run();