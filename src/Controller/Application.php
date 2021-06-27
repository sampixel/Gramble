<?php

/**
 * This file contains the main core of the application process
 * 
 * @package	App\Controller
 * @license https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com
 */

namespace App\Controller;

/** Class Application */
class Application {

	public Router $router;
	public Request $request;

	/** Constructor */
	public function __construct() {
		$this->router = new Router;
		$this->request = new Request;
	}

	/**
	 * Enable or Disable log errors in browser.
	 * The value must be 1 or 0
	 * 
	 * @param integer $num The value 1 or 0
	 */
	public function enable_errors($num) {
		ini_set("display_errors", $num);
		ini_set("display_startup_errors", $num);
		ini_set("error_reporting", -$num);
	}

	/**
	 * Gets the path, the method and the callback function
	 * 
	 * Once it gets the actual path and method, it
	 * executes the function callback
	 */
	public function run() {
		$path	  = $this->request->get_path();
		$method   = $this->request->get_method();
		$callback = $this->router->routes[$method][$path];

		echo __DIR__ . "/../View/profile.phtml";
		include(__DIR__ . call_user_func($callback));
	}

}