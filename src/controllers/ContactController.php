<?php

/**
 * This class handles the contact section
 * 
 * @package src\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace src\controllers;

use app\controllers\Application;

class ContactController extends Application {

	public function retrieveGetList() {
		$this->request->getBody();
	}

	/**
	 * Return the post data values submitted
	 * @return array $contactInfo The array containing post data
	 */
	public function retrievePostList() {
		$contactInfo = $this->request->getBody();

		return $contactInfo;
	}

}