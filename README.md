# Gramble framework

### Disclaimer
This documentation about how to build a PHP framework is for educational only purpose.\
The way others frameworks work and other similar concepts are mandatory to know if you want to understand what they do in the background.\
Obviously i just tried to replicate what i saw in this video [Use PHP to Create an MVC Framework - Full Course](https://www.youtube.com/watch?v=6ERdu4k62wI&list=LL&index=17&t=1902s).

### Requirements
In order to use gramble you need to install it (Check Releases).

### Instructions

##### Run the php's local web server
To launch the web server run `php -S localhost:8080 -t public/` from inside your project directory.\
Then open your favorite browser and type the address on the url field.

##### Create a new Route Link annotation function
The program core starts from `/public/index.php` where all the classes are initialized through an `autoloader.php` file, so you don't have to request the same class every time you need it by calling the `require_once` or `include_once` function.\
From within this `/public/index.php` you should be able to bind the to relative route name a given function.\
As you will see i instantiated a new class called `Application` which is the class that provides basic functionality for getting general requests and for running the application by showing the content in the form of html.\
The first thing to do is to call the public method of the `Router` class depending on what method do you want to use.\
The following are the three main method function used to run a given controller file:

- get(`@param` $route, `@param` $callback, `@return` [])
	- $route `string` The given route name
	- $callback `callback` The given function to execute
	- [] `array` The array containing the view path at index 0, the array of data to pass at index 1
	```php
	$app->router->get("/", function() {
		$arrayData = [];
		return ["/src/views/home.php", $arrayData];
	});
	```
- post(`@param` $route, `@param` $callback, `@return` [])
	- $route `string` The given route name
	- $callback `callback` The given function to execute
	- [] `array` The array containing the view path at index 0, the array of data to pass at index 1
	```php
	$app->router->post("/", function() {
		$arrayData = [];
		return ["/src/views/home.php", $arrayData];
	});
	```
- match(`@param` $route, `@param` []: [ `@param` "GET", `@param` "POST", `@return` [] ])
	- $route `string` The given route name
	- [] `array` The array containing both methods function
		- "GET"  `callback` The given function to execute for "get" method
		- "POST" `callback` The given function to execute for "post" method
		- [] `array` Both must return an array containing the view path at index 0, the array of data to pass at index 1
		```php
		$app->router->match("/", [
			"GET" => function() {
				$arrayData = [];
				return ["/src/views/home.php", $arrayData];
			},
			"POST" => function() {
				$arrayData = [];
				return ["/src/views/home.php", $arrayData];
			}
		]);
		```


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