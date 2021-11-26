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
     * @var object $router
     */
    public Router $router;
    /**
     * @var object $request
     */
    public Request $request;
    /**
     * @var object $response
     */
    public Response $response;
    /**
     * @var object $database
     */
    public Database $database;
    /**
     * @var object $config
     */
    public Config $config;
    /**
     * @var object $parser
     */
    public Parser $parser;

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
        $callback = $this->resolve($params[0], $params[1]);
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
        $base = $this->request->getBase(APP_ROOT . (!empty($data["layout"]) ? $this->request->slashPadding($data["layout"]) : $this->config->base));
        $footer = $this->config->footer !== null ? $this->request->getFooter(APP_ROOT . $this->config->footer) : null;
        $content = $this->request->getContent(APP_ROOT . $this->request->slashPadding($view), $data);
        $route   = $this->request->relRoute();

        $cssFile = $this->parser->findFile($route, dirname(dirname(__DIR__)) . "/public/assets/css");
        $jsFile  = $this->parser->findFile($route, dirname(dirname(__DIR__)) . "/public/assets/js");

        $origin  = ["%LINK%", "%TITLE%", "%CONTENT%", "%FOOTER%", "%SCRIPT%"];
        $replace = [$cssFile, ucfirst($route), $content, $footer, $jsFile];

        echo str_replace($origin, $replace, $base);
    }

}