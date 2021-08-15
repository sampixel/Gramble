<?php

/**
 * This file automatically requires a given class
 */
spl_autoload_register(function($className) {
    $classPath = str_replace("\\", "/", $className);
    require APP_ROOT . "/$classPath.php";
});