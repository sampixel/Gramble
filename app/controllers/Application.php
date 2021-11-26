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
use app\libraries\Parser;

/**
 * Class Application
 * 
 * @param object $router
 * @param object $request
 * @param object $response
 * @param object $database
 * @param object $config
 * @param object $parser
 * 
 * - run()
 * - resolve()
 * - render()
 */
class Application {

    /**
     * @var Route $router
     */
    public $router;
    /**
     * @var Request $request
     */
    public $request;
    /**
     * @var Response $response
     */
    public $response;
    /**
     * @var Database $database
     */
    public $database;
    /**
     * @var Config $config
     */
    public $config;
    /**
     * @var Parser $parser
     */
    public $parser;

    public function __construct() {
        $this->router   = new Router();
        $this->response = new Response();
        $this->request  = new Request();
        $this->database = new Database();
        $this->config   = new Config();
        $this->parser   = new Parser();
    }

    /**
     * Gets the given method, route and then render its view
     * and if no view was found, a 404 page will be throwned.
     */
    public function run() {
        $route  = $this->request->route();
        $method = $this->request->method();
        $params = $this->router->callback($method, $route);
        $callback = $params !== null ? $this->resolve($params[0], $params[1]) : false;
        if ($callback === false) {
            $this->request->getError($this->response, $this->config);
        }
    }

    /**
     * Runs the class method if this one exists in class object.
     * @param object $className  The class to examine
     * @param string $methodName The method to match
     * @return boolean
     */
    public function resolve($className, $methodName) {
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

        return false;
    }

    /**
     * This method replaces the given view in the base file and displays the final view.
     * @param string $view The view path
     * @param array  $data The array data
     */
    public function render($view, $data) {
        $base = $this->request->getBase(APP_ROOT . (!empty($data["layout"]) ? $this->request->prependSlash($data["layout"]) : $this->config->base));
        $footer = $this->config->footer !== null ? $this->request->getFooter(APP_ROOT . $this->config->footer) : null;
        $content = $this->request->getContent(APP_ROOT . $this->request->prependSlash($view), $data);
        $route = $this->request->relativeRoute();

        $css = $this->parser->findFile($route, dirname(dirname(__DIR__)) . "/public/assets/css");
        $js = $this->parser->findFile($route, dirname(dirname(__DIR__)) . "/public/assets/js");

        $origin  = ["%LINK%", "%TITLE%", "%CONTENT%", "%FOOTER%", "%SCRIPT%"];
        $replace = [$css, ucfirst($route), $content, $footer, $js];

        echo str_replace($origin, $replace, $base);
    }

}