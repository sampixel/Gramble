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

	/**
	 * Checks params type inside argument function
	 * @param  string   $route	  The route to examine
	 * @param  callback $callback The callback to examine
	 * @return boolean  true|false 
	 */
	public function checkParamsType($route, $callback) {

	}

	/**
	 * Checks the route name and includes slash whenever it is missed
	 * @param  string $route    The given route
	 * @return string $fullPath The full route name
	 */
	public function checkRoute($route) {
		$fullPath = DIR;
		if (substr($route, 0, 1) !== "/") {
			$fullPath .= "/" . $route;
		} else {
			$fullPath .= $route;
		}

		return $fullPath;
	}

	/**
	 * Defines a get method in the given route
	 * @param string	$route 		The given route
	 * @param callback	$callback 	The route's callback
	 */
	public function get($route, $callback) {
		//$this->routes["get"][$this->checkRoute($route)] = $callback;
		$this->routes["get"][$route] = $callback;
	}

	/**
	 * Defines a post method in the given route
	 * @param string	$route		The given route
	 * @param callback 	$callback	The route's callback
	 */
	public function post($route, $callback) {
		//$this->routes["post"][$this->checkRoute($route)] = $callback;
		$this->routes["post"][$route] = $callback;
	}

	/**
	 * Defines the route and method to match
	 * @param string $route   The given route
	 * @param array  $methods The array containing function methods
	 */
	public function match($route, $methods) {
		$this->routes["get"][$route]  = $methods["GET"];
		$this->routes["post"][$route] = $methods["POST"];
	}

	/**
	 * Returns protected array $routes
	 * @return array $routes The array containing routes
	 */
	public function getRoutes() {
		return $this->routes;
	}

}