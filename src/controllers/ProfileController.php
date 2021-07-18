<?php

/**
 * This class handles the profile section
 * 
 * @package src\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace src\controllers;

class ProfileController {

	/**
	 * Returns the user info details
	 * @return array $profileInfo The array containing view and info
	 */
	public function getProfileInfo() {
		$profileInfo = [
			"name" => "Samuel",
			"jobs" => "Developer",
			"born" => "Italy"
		];

		return $profileInfo;
	}

}