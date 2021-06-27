<?php

/**
 * This file contains routers managing
 * 
 * @package	App\Controller
 * @license https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com>
 */

namespace App\Controller;

/** Class Router */
class Router {

	/** Constructor */
	public function __construct() {
		$this->routes = [];
	}
	
	/**
	 * Adds a new path to given method array field
	 * and gives to it a callback function
	 * 
	 * @param string	$path		The actual pathname
	 * @param string	$method		The method requested
	 * @param callback	$callback	The function callback
	 */
	public function match($path, $method, $callback) {
		$this->routes[$method][$path] = $callback;
	}

}