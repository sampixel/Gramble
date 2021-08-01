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
 * @param string $_base
 * @param string $_footer
 * @param string $_error
 */
class Config {

    /** @var string $_base */
    public string $base = "/app/views/base.html";

    /** @var string $_footer */
    public string $footer = "/app/views/footer.html";

    /** @var string $error */
    public string $error = "/app/views/error.html";

}