# Gramble framework

## Disclaimer
This documentation about how to build a PHP framework is for educational only purpose.\
The way others frameworks work and other similar concepts are mandatory to know if you want to understand what they do in the background.\
Obviously i just tried to replicate what i saw in this video [Use PHP to Create an MVC Framework - Full Course](https://www.youtube.com/watch?v=6ERdu4k62wI&list=LL&index=17&t=1902s).

## Requirements
In order to use gramble you need to install it (Check Releases).

## Instructions

#### Run the php's local web server
To launch the web server run `php -S localhost:8080 -t public/` from inside your project directory.\
Then open your favorite browser and type the address on the url field.

#### Create a new Route Link annotation function
The program core starts from `/public/index.php` where all the classes are initialized through an `autoloader.php` file, so you don't have to request the same class every time you need it by calling the `require_once` or `include_once` function (instead use the `use` php keyword to initialize classes).\
From within this `/public/index.php` you should be able to bind the to relative route name a given function and the method it uses.\
As you will see i instantiated a new class called `Application` which is the class that provides basic functionality to elaborate general requests and for running the application by showing the content in form of html.\
The first thing to do is to call the public method of the `Router` class depending on what method you want to use.\
The following is the very basic syntax for executing a controller method:

- get(`@param` $route, `@param` $callback)
    - $route `string` The requested route
    - $callback `array` The array containing class and method name
        - `@param` The name of class to trigger written as namespace
        - `@param` The name of method to trigger written as string
        ```php
        ...
        $app->router->get("/", [src\controllers\MainController::class, "getUserInfo"]);
        ...
        $app->run();
        ```
- post(`@param` $route, `@param` $callback)
    - $route `string` The requested route
    - $callback `array` The array containing class and method name
        - `@param` The name of class to trigger written as namespace
        - `@param` The name of method to trigger written as string
        ```php
        ...
        $app->router->get("/", [src\controllers\MainController::class, "postUserInfo"]);
        ...
        $app->run();
        ```

## License

### The MIT License (MIT)

#### Copyright © 2021 sampixel

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


### TODO LIST
- [x] Add `render` feature
- [ ] Avoid including "DIR" every time a file path is added to the array
- [ ] Add method function inside Router class for controlling the type of returning values from get, post or match function
- [ ] Create a make file to enable gramble package locally/globally
- [ ] Add a template that can be extended from other views
- [x] Customize the 404 status view
- [ ] Ignore all html/php files from src folder (this should be a skeleton project)
- [x] url need to fix when the path end with "/" (page is loaded correctly but can't load style and script files)
- [x] Find a way to pass an array of data inside the php view
- [x] Add "post" method function