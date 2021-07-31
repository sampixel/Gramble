<?php

/**
 * This file contains all configurations for runnig the framework properly
 * 
 * @package app\libraries
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\libraries;

/**
 * Class Config
 * 
 * - retrieveErrorPath()
 */
class Config {

    protected string $_404    = "/app/views/404.html";
    protected string $_base   = "/app/views/base.html";
    protected string $_footer = "/app/views/footer.html";

    /**
     * Returns the 404 page path
     * @return string The view 404
     */
    public function error() {
        return DIR . $this->_404;
    }

    /**
     * Returns the footer path
     * @return string The footer view
     */
    public function footer() {
        return DIR . $this->_footer;
    }

    /**
     * Returns the base path
     * @return string The base view
     */
    public function base() {
        return DIR . $this->_base;
    }

}