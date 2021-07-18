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
		$this->router	= new Router;
		$this->response = new Response;
		$this->request 	= new Request;
		$this->config   = new Config;
	}

	/**
	 * This method gets the given method, route and then render its view
	 * and if no view was found, a 404 page will be throwned
	 */
	public function run() {
		$path	  = $this->request->getPath();
		$method   = $this->request->getMethod();
		$callback = $this->router->getRoutes()[$method][$path] ?? false;

		if ($callback !== false) {
			$this->render(call_user_func($callback));
		} else {
			$this->request->getErrorPage($this->response, $this->config);
		}
	}

	/**
	 * This method replaces the given view in the base file and displays the final view
	 * @param array $view The array containing view and data
	 */
	public function render(array $view) {
		$footerContent	= $this->request->getFooter(DIR . "/app/views/footer.html");
		$baseLayout 	= $this->request->getLayout(DIR . "/app/views/base.html");
		$viewContent 	= $this->request->getContent($view);
		$routeName 		= $this->request->getRouteName();

		$arrayOrigin	= ["%LINK%", "%TITLE%", "%CONTENT%", "%FOOTER%"];
		$arrayReplace 	= [$routeName, ucfirst($routeName), $viewContent, $footerContent];

		$finalView = str_replace($arrayOrigin, $arrayReplace, $baseLayout);
		echo $finalView;
	}

}