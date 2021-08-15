<?php

/**
 * @package app\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com
 */

namespace app\libraries;

use \PDO;
use app\libraries\Config;

/**
 * Class Database
 * 
 * - createTable()
 */
class Database {

    public function __construct() {
        /**
         * Configuring the Data Source Name for retrieving the following:
         * - hostname: The hostname such as localhost, 127.0.0.1, 0.0.0.0
         * - dbname: The name of the database to use
         */
        $this->dsn = "mysql:host=" . Config::$hostname . ";dbname=" . Config::$dbname;
        /**
         * Configuring a new PDO connection with the following properties:
         * - dsn: The previous Data Source Name
         * - username: The username to which the database belongs to
         * - password: The password used to access the database
         */
        $this->pdo = new \PDO($this->dsn, Config::$username, Config::$password);
        /**
         * Setting attributes to PDO connection
         * @link https://www.php.net/manual/en/pdo.setattribute.php
         */
        //$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        $this->pdo->setAttribute(\PDO::ATTR_PERSISTENT, \PDO::CASE_LOWER);
    }

    /**
     * Creates a new table in database
     * 
     * @param array $params The array containing table data
     */
    public function createTable($params) {
        $sql = "CREATE TABLE IF NOT EXISTS {$params["label"]} (";
        foreach ($params["columns"] as $key => $value) {
            $sql .= "$key $value ";
        }
        $sql .= ");";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

}