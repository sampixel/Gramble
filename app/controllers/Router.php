<?php

/**
 * @package app\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\controllers;

/**
 * Class Router
 * 
 * @param array $routes
 * 
 * - checkRoute()
 * - get()
 * - post()
 * - callback()
 */
class Router {

    /** @var array $routes */
    protected array $routes = [];

    /**
     * Checks the route name and includes slash whenever it is missed
     * 
     * @param  string $route The given route
     * 
     * @return string $fullPath The full route name
     */
    public function checkRoute($route) {
        $fullPath = APP_ROOT;
        if (substr($route, 0, 1) !== "/") {
            $fullPath .= "/" . $route;
        } else {
            $fullPath .= $route;
        }

        return $fullPath;
    }

    /**
     * Defines a get method in the given route
     * 
     * @param string    $route      The given route
     * @param callback  $callback   The route's callback
     */
    public function get($route, $callback) {
        $this->routes["get"][$route] = $callback;
    }

    /**
     * Defines a post method in the given route
     * 
     * @param string    $route    The given route
     * @param callback  $callback The route's callback
     */
    public function post($route, $callback) {
        $this->routes["post"][$route] = $callback;
    }

    /**
     * Returns controller-method pairs as string
     * 
     * @param  string $method The requested method
     * @param  string $route  The requested route
     * 
     * @return array The array containing routes
     */
    public function callback($method, $route) {
        return $this->routes[$method][$route] ?? null;
    }

}