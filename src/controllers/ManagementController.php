<?php

namespace src\controllers;

use app\controllers\Application;

/**
 * Class ManagementController
 * 
 * @package src\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */
class ManagementController extends Application {

    public function ajaxAction() {
        $jsonData = [
            "fname" => "Ajjoooo",
            "lname" => "Ueeeeee"
        ];

        return json_encode($jsonData);
    }

}