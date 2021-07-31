<?php

/**
 * This file contains the main core of the application process
 * 
 * @package	app\controllers
 * @license https://mit-license.org/ MIT License
 * @author	Samuel Reka <rekasamuel0@gmail.com
 */

namespace app\controllers;

use app\controllers\Router;
use app\controllers\Request;
use app\controllers\Response;
use app\libraries\Config;

/**
 * Class Application
 */
class Application {

    public Router $router;
    public Request $request;
    public Response $response;
    public Config $config;

    public function __construct() {
        $this->router   = new Router;
        $this->response = new Response;
        $this->request  = new Request;
        $this->config   = new Config;
    }

    /**
     * Runs method class if this one exists in class object
     * @param  object $className  The class to examine
     * @param  string $methodName The method to match
     * @return object $method     The method
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
        $path   = $this->request->path();
        $method = $this->request->method();
        $params = $this->router->getRoutes()[$method][$path];
        $callback = $this->methodClass($params[0], $params[1]);
        if (!$callback) {
            $this->request->getError($this->response, $this->config);
        }
    }

    /**
     * This method replaces the given view in the base file and displays the final view
     * @param string $view The view path
     * @param array  $data The array data
     */
    public function render($view, $data) {
        $footerContent = $this->request->getFooter($this->config->footer());
        $baseLayout    = $this->request->getLayout($this->config->base());
        $viewContent   = $this->request->getContent(DIR . $this->request->slashPadding($view), $data);
        $routeName     = $this->request->getRouteName();

        $arrayOrigin   = ["%LINK%", "%TITLE%", "%CONTENT%", "%FOOTER%"];
        $arrayReplace  = [$routeName, ucfirst($routeName), $viewContent, $footerContent];

        $finalView = str_replace($arrayOrigin, $arrayReplace, $baseLayout);
        echo $finalView;
    }

}