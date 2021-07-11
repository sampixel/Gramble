<?php

/**
 * This file contains basic functionality for running the framework
 * 
 * @license	https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com>
 */

define("DIR", dirname(__DIR__));

require DIR . "/app/controllers/Application.php";
//require DIR . "/src/controllers/DashboardController.php";
//require DIR . "/src/controllers/ProfileController.php";

use app\controllers\Application;
//use src\controllers\DashboardController;
//use src\controllers\ProfileController;

$app = new Application(DIR);

$app->router->get("/", function() {
	//$dashBoardController = new DashboardController; .. from DashboardController will be managed all informations

	$arrayData = [];
	//$arrData["userinfo"] = $dashBoard->getUserInfo();
	return [DIR . "/src/views/home.php", $arrayData];
});

$app->router->get("/profile", function() {
	//$profileController = new ProfileController; .. get all informations and so on

	$arrayData = [];
	//$arrData["userinfo"] = $profileController->getUserInfo();
	return [DIR . "/src/views/profile.php", $arrayData];
});

$app->run();