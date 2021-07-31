<?php

/**
 * This class handles the profile section
 * 
 * @package src\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace src\controllers;

use app\controllers\Application;

class ProfileController extends Application {

    /**
     * Returns the user info details
     */
    public function getProfileInfo() {
        $arrData["userinfo"] = [
            "name" => "Samuel",
            "jobs" => ["Mechanic", "Dealer", "Programmer"],
            "born" => "Italy (TR)"
        ];
        $this->render("/src/views/profile.php", $arrData);
    }

}