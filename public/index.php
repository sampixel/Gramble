<?php

/**
 * This file contains basic functionality for running the framework
 * 
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

define("DIR", dirname(__DIR__));

require_once DIR . "/public/autoloader.php";

$app = new app\controllers\Application;

$app->router->get("/", [src\controllers\UserController::class, "retrieveUserInfo"]);
$app->router->get("/profile", [src\controllers\ProfileController::class, "getProfileInfo"]);
/*$app->router->get("/contact", src\controllers\ContactController::retrieveGetList);
$app->router->post("/contact", src\controllers\ContactController::retrievePostList);*/

$app->run();