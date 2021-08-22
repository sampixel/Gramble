<?php

/**
 * @package app\controllers
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\controllers;

/**
 * Class Request
 * 
 * - route()
 * - method()
 * - get()
 * - post()
 * - parser()
 * - absRoute()
 * - getBase()
 * - getContent()
 * - getFooter()
 * - getError()
 * - slashPadding()
 * - sessionStart()
 */
class Request {

    /**
     * Gets the effective absolute route name without including queries or slashes
     * 
     * @return string $route The effective path name
     */
    public function route() {
        $route = $_SERVER["REQUEST_URI"] ?? "/";
        $pos = strpos($route, "?");
        $path = ($pos !== false ? substr($route, 0, $pos) : $route);
        $route = ($route !== "/" && $route[strlen($route)-1] === "/" ? substr_replace($route, "", -1) : $route);

        return $route;
    }

    /**
     * Gets the method for the actual route name
     * 
     * @return string The actual method used
     */
    public function method() {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    /**
     * Sanitize data for get method
     * 
     * @return array $body The array containing get sanitized data
     */
    public function get() {
        $body = [];
        if ($this->method() === "get") {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    /**
     * Sanitize data for post method
     * 
     * @return array $body The array containing post sanitized data
     */
    public function post() {
        $body = [];
        if ($this->method() === "post") {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    /**
     * Checks if the route name is available inside folders, then returns the relative path
     * 
     * @param  string $file The given filename to match
     * @param  string $root The given directory name
     * 
     * @return string $path The relative pathname
     */
    public function parser($file, $root) {
        $path = $file;
        $ext = $root === "styles" ? "css" : "js";
        $mainScan = array_diff(scandir(APP_ROOT . "/public/assets/$root"), [".", ".."]);
        foreach ($mainScan as $main) {
            if (!is_dir(APP_ROOT . "/public/assets/$root/$main")) {
                if ($main === "$file.$ext") {
                    break;
                }
            } else {
                $subScan = array_diff(scandir(APP_ROOT . "/public/assets/$root/$main"), [".", ".."]);
                foreach ($subScan as $sub) {
                    if (!is_dir(APP_ROOT . "/public/assets/$root/$main/$sub")) {
                        if ($sub === "$file.$ext") {
                            $path = "$main/$file";
                            break;
                        }
                    } else {
                        $deepScan = array_diff(scandir(APP_ROOT . "/public/assets/$root/$main/$sub"), [".", ".."]);
                        foreach ($deepScan as $deep) {
                            if (!is_dir(APP_ROOT . "/public/assets/$root/$main/$sub/$deep")) {
                                if ($deep === "$file.$ext") {
                                    $path = "$main/$sub/$file";
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $path;
    }

    /**
     * Returns the relative route name without slashes
     * 
     * @return string $routeName The current route name
     */
    public function relRoute() {
        $explodedURL = explode("/", $_SERVER["REQUEST_URI"]);
        if (empty($explodedURL[count($explodedURL)-1])) {
            unset($explodedURL[count($explodedURL)-1]);
        }
        $routeName = (empty($explodedURL[0]) && empty($explodedURL[1]) ? "home" : $explodedURL[count($explodedURL)-1]);

        return $routeName;
    }

    /**
     * Returns the base layout as html text
     * 
     * @param  string $basePath The base path
     * 
     * @return string $baseHtml  The buffer layout
     */
    public function getBase($basePath) {
        ob_start();
        require_once $basePath;
        $baseHtml = ob_get_clean();

        return $baseHtml;
    }

    /**
     * Returns the inner content as html text and passes array data within it
     * 
     * @param  string $viewPath The view path
     * @param  array  $arrData  The array containing data
     * 
     * @return string $viewHtml The view as html
     */
    public function getContent($viewPath, $arrData) {
        foreach ($arrData as $key => $value) {
            $$key = $value;
        }
        ob_start();
        require_once $viewPath;
        $viewHtml = ob_get_clean();

        return $viewHtml;
    }

    /**
     * Returns the footer content as html text
     * 
     * @param  string $footerPath The footer path
     * 
     * @return string $footerHtml The footer as html
     */
    public function getFooter($footerPath) {
        ob_start();
        require_once $footerPath;
        $footerHtml = ob_get_clean();

        return $footerHtml;
    }

    /**
     * Requires 404 status when route does not match
     * 
     * @param object $respone The Response object instance
     * @param object $config  The Config object instance
     */
    public function getError($response, $config) {
        if ($response->setResponseCode(404)) {
            require APP_ROOT . $config->error;
        }
    }

    /**
     * Returns the given path with slash at beginning, if it's missed
     * 
     * @param  string $path    The given path to add slash to
     * 
     * @return string $newPath The path if slash padding
     */
    public function slashPadding($path) {
        $newPath = $path;
        if (substr($path, 0, 1) !== "/") {
            $newPath = "/$path";
        }

        return $newPath;
    }

    /**
     * Starts a new session
     */
    public function sessionStart() {
        session_start();
    }

}