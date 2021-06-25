<?php

/**
 * This file contains basic functionality for running the framework.
 * Basically it provides routing access from the browser.
 * 
 * @package	https://github.com/sampixel/gramble.git
 * @license	https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com>
 */

use App\Application;
use App\Configuration;

$app	= new Application();
$config = new Configuration();

$app->$router->get("/", function() {
	retun "Welcome to Gramble " . $config->version;
});