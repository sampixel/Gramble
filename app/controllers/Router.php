<?php

/**
 * This file contains routers managing
 * 
 * @package	app\controllers
 * @license https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\controllers;

/**
 * Class Router
 */
class Router {

	protected array $routes = [];
	public static string $ROOTPATH;

	public function __construct($DIR) {
		self::$ROOTPATH = $DIR;
	}

	/**
	 * Defines a get method in the given route
	 * @param string	$route 		The actual route
	 * @param callback	$callback 	The route's callback
	 */
	public function get($route, $callback) {
		$this->routes["get"][$route] = $callback;
	}

	/**
	 * Defines a post method in the given route
	 * @param string	$route		The actual route
	 * @param callback 	$callback	The route's callback
	 */
	public function post($route, $callback) {
		$this->routes["post"][$route] = $callback;
	}

	/**
	 * Returns protected array $routes
	 * @return array $routes The array containing routes
	 */
	public function getRoutes() {
		return $this->routes;
	}

}