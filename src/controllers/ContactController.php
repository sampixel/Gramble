<?php

namespace src\controllers;

use app\controllers\Application;

/**
 * Class ContactController
 * 
 * @package src\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */
class ContactController extends Application {

    /**
     * Retrieves data using get method
     */
    public function retrieveGetList() {
        $arrData["submitted"] = $this->request->get();
        $this->render("src/views/contact.php", $arrData);
    }

    /**
     * Sends data using post method
     */
    public function retrievePostList() {
        $arrData["submitted"] = $this->request->post();
        $this->render("src/views/contact.php", $arrData);
    }

}