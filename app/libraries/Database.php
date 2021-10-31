<?php

/**
 * @package app\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com
 */

namespace app\libraries;

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
        $this->pdo->setAttribute(\PDO::ATTR_PERSISTENT, \PDO::CASE_LOWER);
    }

    /**
     * Selects the given column from the given table
     * 
     * @param  string $column The column
     * @param  string $table  The table
     * @return string $sql    The sql command
     */
    public function select($column, $table) {
        $sql = "SELECT $column FROM $table";

        return $sql;
    }

    /**
     * Selects all from the given table
     * 
     * @param  string $table The table
     * @return string $sql   The sql command
     */
    public function selectAll($table) {
        $sql = "SELECT * FROM $table";

        return $sql;
    }

    /**
     * Where condition for sql
     * 
     * @param  string $cond1 The first condition
     * @param  string $cond2 The second condition
     * @return string $sql   The sql command
     */
    public function where($cond1, $cond2) {
        $sql = "WHERE '$cond1'='$cond2'";

        return $sql;
    }

    /**
     * Applies all migrations so the application will
     * be aligned to its most recent version
     */
    public function applyMigrations() {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $migrations = scandir(APP_ROOT . "/app/migrations", 2);

        var_dump($migrations);
        var_dump($appliedMigrations);
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

    /**
     * Creates a Migration table to store all migrations file
     */
    public function createMigrationsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    migration VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=INNODB;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    /**
     * Get already applied migrations file containing sql command
     * 
     * @return array The array containing the statement's result
     */
    public function getAppliedMigrations() {
        $sql = $this->select("migration", "migrations");
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        //return $stmt->fetchAll(\PDO::FETCH_COLUMN);
        return $stmt->fetchAll();
    }

}