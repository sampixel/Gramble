<?php

/**
 * This file contains url string manipolation to
 * match the exact route requested from the client
 * 
 * @package app\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\controllers;

class Request {

	/**
	 * Gets the effective absolute route name without including queries or slashes
	 * @return string $path The effective path name
	 */
	public function getPath() {
		$path = $_SERVER["REQUEST_URI"] ?? "/";
		$pos = strpos($path, "?");
		$path = ($pos !== false ? substr($path, 0, $pos) : $path);
		$path = ($path !== "/" && $path[strlen($path)-1] === "/" ? substr_replace($path, "", -1) : $path);

		return $path;
	}

	/**
	 * Gets the method for the actual route name
	 * @return string The actual method used
	 */
	public function getMethod() {
		return strtolower($_SERVER["REQUEST_METHOD"]);
	}

	/**
	 * Returns the absolute route name without slashes
	 * @return string $routeName The current route name
	 */
	public function getRouteName() {
		$explodedURL = explode("/", $_SERVER["REQUEST_URI"]);
		if (empty($explodedURL[count($explodedURL)-1])) {
			unset($explodedURL[count($explodedURL)-1]);
		}
		$routeName = (empty($explodedURL[0]) && empty($explodedURL[1]) ? "home" : $explodedURL[count($explodedURL)-1]);

		return $routeName;
	}

	/**
	 * Returns the base layout as html text
	 * @param  string $basePath The base path
	 * @return string $baseHtml  The buffer layout
	 */
	public function getLayout($basePath) {
		ob_start();
		require_once $basePath;
		$baseHtml = ob_get_clean();

		return $baseHtml;
	}

	/**
	 * Returns the inner content as html text and passes array data within it
	 * @param  array  $viewPath The array containing data
	 * @return string $viewHtml The view as html
	 */
	public function getContent(array $viewPath) {
		foreach ($viewPath[1] as $key => $value) {
			$$key = $value;
		}

		ob_start();
		require_once $viewPath[0];
		$viewHtml = ob_get_clean();

		return $viewHtml;
	}

	/**
	 * Returns the footer content as html text
	 * @param  string $footerPath The footer path
	 * @return string $footerHtml The footer as html
	 */
	public function getFooter($footerPath) {
		ob_start();
		require_once $footerPath;
		$footerHtml = ob_get_clean();

		return $footerHtml;
	}

	/**
	 * Sanitize the method for get and post to avoid malicious submitted data
	 * @return array $bodyContent The array containing sanitized data
	 */
	public function getBody() {
		$bodyContent = [];

		if ($this->getMethod() === "get") {
			foreach ($_GET as $key => $value) {
				$bodyContent[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		} elseif ($this->getMethod() === "post") {
			foreach ($_POST as $key => $value) {
				$bodyContent[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}

		return $bodyContent;
	}

	/**
	 * Requires 404 status when route does not match
	 * @param object $respone The Response object instance
	 * @param object $config  The Config object instance
	 */
	public function getErrorPage($response, $config) {
		if ($response->setResponseCode(404)) {
			require DIR . $config->retrieveErrorPath();
		}
	}

}