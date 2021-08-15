<?php

/**
 * @package app\libraries
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\libraries;

/**
 * Class Config
 * 
 * @param string $base
 * @param string $footer
 * @param string $error
 * @param string $hostname
 * @param string $dbname
 * @param string $root
 * @param string $password
 */
class Config {

    /** @var string $base The base view layout */
    public string $base = "/app/views/base.html";
    /** @var string $footer The footer view layout */
    public string $footer = "/app/views/footer.html";
    /** @var string $error The error view layout */
    public string $error = "/app/views/error.html";

    /** @var string $hostname The host name */
    public static string $hostname = "localhost";
    /** @var string $dbname The database name */
    public static string $dbname = "test";
    /** @var string $username The user name */
    public static string $username = "root";
    /** @var string $password The password */
    public static string $password = "123";

}