<?php

/**
 * This file automatically requires a given class
 * @param string $className The class to load
 */
spl_autoload_register(function($className) {
    $classPath = str_replace("\\", "/", $className);
    require APP_ROOT . "/$classPath.php";
});