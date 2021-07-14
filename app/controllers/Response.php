<?php

/**
 * This file gives response status to browser
 * 
 * @package app\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\controllers;

class Response {

	public static string $ROOTPATH;

	public function __construct($DIR) {
		self::$ROOTPATH = $DIR;
	}

	/**
	 * Sets a status code of 404
	 */
	public function setStatusError() {
		http_response_code(404);
	}

}