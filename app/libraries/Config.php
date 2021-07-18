<?php

/**
 * This file contains all configurations for runnig the framework properly
 * 
 * @package app\libraries
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\libraries;

class Config {

	private string $_404 = "/app/views/404.html";

	/**
	 * Returns the 404 page path
	 * @return string $errorPath The view 404
	 */
	public function retrieveErrorPath() {
		$errorPath = $this->_404;

		return $errorPath;
	}

}