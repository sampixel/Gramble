<?php

/**
 * This file contains basic functionality for running the framework
 * 
 * @license	https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com>
 */

define("DIR", dirname(__DIR__));

require_once DIR . "/public/autoloader.php";

use app\controllers\Application;
use src\controllers\ProfileController;
use src\controllers\ContactController;

$app = new Application;

$app->router->get("/", function() {
	$arrayData = [];
	return [DIR . "/src/views/home.php", $arrayData];
});

$app->router->get("/profile", function() {
	$profileController = new ProfileController;
	$arrayData["userinfo"] = $profileController->getProfileInfo();

	return [DIR . "/src/views/profile.php", $arrayData];
});

$app->router->match("/contact", [
	"GET"  => function() {
		$contactController = new ContactController;
		$arrayData = [];
		$arrayData["content"] = $contactController->retrieveGetList();

		return [DIR . "/src/views/contact.php", $arrayData];
	},
	"POST" => function() {
		$contactController = new ContactController;
		$arrayData = [];
		$arrayData["submitted"] = $contactController->retrievePostList();

		return [DIR . "/src/views/contact.php", $arrayData];
	}
]);

$app->run();