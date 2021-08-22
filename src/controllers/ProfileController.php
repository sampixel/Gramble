<?php

namespace src\controllers;

use app\controllers\Application;

/**
 * Class ProfileController
 * 
 * @package src\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */
class ProfileController extends Application {

    /**
     * Shows profile info
     */
    public function getProfileInfo() {
        $arrData["profileinfo"] = [
            "fname" => "Michélé",
            "lname" => "Ssempre io",
            "city" => "Arrone 4ever"
        ];

        $this->render("src/views/profile.php", $arrData);
    }

}