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
                if (in_array($methodName, $classMethods)) {
                    $controller = new $className;
                    $controller->$key();
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
        $callback = $this->methodClass($params[0], $params[1]);
        if ($callback === null) {
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
        $baseLayout   = $this->config->base !== null ? $this->request->getBase(DIR . $this->config->base) : "<html><head></head><body></body></html>";
        $footerLayout = $this->config->footer !== null ? $this->request->getFooter(DIR . $this->config->footer) : "<footer></footer>";
        $viewContent  = $this->request->getContent(DIR . $this->request->slashPadding($view), $data);
        $absRouteName = $this->request->getRouteName();
        $cssFileName  = $this->request->fileParser($absRouteName, "css");
        $jsFileName   = $this->request->fileParser($absRouteName, "js");

        $arrayOrigin  = ["%LINK%", "%TITLE%", "%CONTENT%", "%FOOTER%", "%SCRIPT%"];
        $arrayReplace = [$cssFileName, ucfirst($absRouteName), $viewContent, $footerLayout, $jsFileName];

        $finalView = str_replace($arrayOrigin, $arrayReplace, $baseLayout);
        echo $finalView;
    }

}