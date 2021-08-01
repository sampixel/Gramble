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

    /**
     * Retrieves data using get method
     */
    public function retrieveGetList() {
        $arrData = $this->request->getBody();
        $this->render("src/views/contact.php", $arrData);
    }

    /**
     * Sends data using post method
     */
    public function retrievePostList() {
        $arrData = $this->request->getBody();
        $this->render("src/views/contact.php", $arrData);
    }

}