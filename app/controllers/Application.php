<?php

/**
 * This file contains the main core of the application process
 * 
 * @package app\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com
 */

namespace app\controllers;

use app\controllers\Router;
use app\controllers\Request;
use app\controllers\Response;
use app\libraries\Database;
use app\libraries\Config;

/**
 * Class Application
 */
class Application {

    public Router $router;
    public Request $request;
    public Response $response;
    public Database $database;
    public Config $config;

    public function __construct() {
        $this->router   = new Router;
        $this->response = new Response;
        $this->request  = new Request;
        $this->database = new Database;
        $this->config   = new Config;
    }

    /**
     * Runs the class method if this one exists in class object
     * 
     * @param  object $className  The class to examine
     * @param  string $methodName The method to match
     */
    public function methodClass($className, $methodName) {
        if ($className !== null) {
            $classMethods = get_class_methods($className);
            foreach ($classMethods as $key) {
                if ($methodName === $key) {
                    $controller = new $className;
                    $controller->$key();
                    return true;
                }
            }
        }
    }

    /**
     * Gets the given method, route and then render its view
     * and if no view was found, a 404 page will be throwned
     */
    public function run() {
        $route  = $this->request->route();
        $method = $this->request->method();
        $params = $this->router->callback($method, $route);
        $callback = $params !== null ? $this->methodClass($params[0], $params[1]) : false;
        if ($callback === false) {
            $this->request->getError($this->response, $this->config);
        }
    }

    /**
     * This method replaces the given view in the base file and displays the final view
     * 
     * @param string $view The view path
     * @param array  $data The array data
     */
    public function render($view, $data) {
        $base    = $this->request->getBase(DIR . ($data["layout"] ? $this->request->slashPadding($data["layout"]) : $this->config->base));
        $footer  = $this->config->footer !== null ? $this->request->getFooter(DIR . $this->config->footer) : "This is the footer";
        $content = $this->request->getContent(DIR . $this->request->slashPadding($view), $data);
        $route   = $this->request->getRouteName();
        $cssFile = $this->request->parser($route, "css");
        $jsFile  = $this->request->parser($route, "js");

        $origin  = ["%LINK%", "%TITLE%", "%CONTENT%", "%FOOTER%", "%SCRIPT%"];
        $replace = [$cssFile, ucfirst($route), $content, $footer, $jsFile];

        echo str_replace($origin, $replace, $base);
    }

}