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

$app->router->get("/", [src\controllers\UserController::class, "getUserInfo"]);

$app->run();