<?php

/**
 * This file gives response status to browser
 * 
 * @package app\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\controllers;

/**
 * Class Response
 * 
 * - setResponseCode()
 */
class Response {

    /**
     * Sets a status code of 404
     * 
     * @param  int  $status The status code
     * @return bool true
     */
    public function setResponseCode($status) {
        http_response_code($status);
        return true;
    }

}