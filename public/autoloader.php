<?php

spl_autoload_register(function($className) {
	$classPath = str_replace("\\", "/", $className);
	require DIR . "/" . $classPath . ".php";
});