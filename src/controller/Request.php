<?php

/**
 * This file contains url string manipolation to
 * match the exact route requested from the client
 * 
 * @package App\Controller
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace App\Controller;

class Request {

	/**
	 * Gets the path from eventual queries mark
	 * 
	 * First off checks if the url request string contains a question mark,
	 * if it is then it extracts a string from start until question mark's position
	 * otherwise it will return the path string like it was.
	 * 
	 * @return string The effective path without queries
	 */
	public function get_path() {
		$path = $_SERVER["REQUEST_URI"] ?? "/";
		$pos = strpos($path, "?");
		$path = ($pos !== false ? substr($path, 0, $pos) : $path);

		return $path;
	}

	/**
	 * Gets the method for the actual pathname
	 * 
	 * @return string The method used
	 */
	public function get_method() {
		return strtolower($_SERVER["REQUEST_METHOD"]);
	}

	/**
	 * Shows 404 status when route does not match
	 * 
	 * @return callback The 404 Status to display
	 */
	public function get_error_page() {
		return function() {
			echo "404 Status Brooohhh<br>";
		};
	}

}