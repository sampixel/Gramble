<?php

namespace src\controllers;

use app\controllers\Application;

/**
 * Class UserController
 */
class UserController extends Application {

    public function getUserInfo() {
        //$response["layout"] = "src/views/template/layout.html";
        $response["userinfo"] = [
            "fname" => "Thomas",
            "lname" => "A.Anderson",
            "former"=> "Software Enginner",
            "movie" => "The Matrix"
        ];

        /*$this->database->createTable([
            "label"   => "mvc_details",
            "columns" => [
                "id"   => "INT PRIMARY KEY AUTO_INCREMENT,",
                "name" => "VARCHAR(255) NOT NULL,",
                "date" => "TIMESTAMP NOT NULL"
            ]
        ]);*/

        $this->render("src/views/home.php", $response);
    }

}