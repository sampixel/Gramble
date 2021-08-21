<?php

/**
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

define("APP_ROOT", dirname(__DIR__));

require_once APP_ROOT . "/package/autoloader.php";
require_once APP_ROOT . "/package/migrations.php";

$app = new app\controllers\Application;

$app->router->get("/", [src\controllers\UserController::class, "getUserInfo"]);
$app->router->get("/profile", [src\controllers\ProfileController::class, "getProfileInfo"]);
$app->router->get("/contact", [src\controllers\ContactController::class, "retrieveGetList"]);
$app->router->post("/contact", [src\controllers\ContactController::class, "retrievePostList"]);
$app->router->get("/jsonprofile", [src\controllers\ManagementController::class, "ajaxAction"]);

$app->run();