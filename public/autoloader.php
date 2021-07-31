<?php

/**
 * This file automatically requires a given class
 */
spl_autoload_register(function($className) {
	$classPath = str_replace("\\", "/", $className);
	require DIR . "/" . $classPath . ".php";
});