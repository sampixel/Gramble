# Gramble MVC Framework

## Disclaimer
This documentation is for educational only purpose.\
The way others frameworks work and other similar concepts are mandatory to know if you want to understand what they do in the background.

<br />

## Instructions

### Run the php's local web server
To launch the web server run `php -S localhost:5000 -t public/` from inside your project directory.\
Then open your favorite browser and type the address on the url field.

---

### Create a new Route Link annotation function
The program core starts from `/public/index.php` where all the classes are initialized through an `autoloader.php` file, so you don't have to request the same class every time you need it by calling the `require_once` or `include_once` function (instead use the `use` php keyword to initialize classes).\
From within this `/public/index.php` you should be able to bind to the relative route name a given function and the method.\
As you will see i instantiated a new class called `Application` which is the class that provides basic functionality to elaborate general requests and for running the application by showing the content in form of html.\
The first thing to do is to call the public method of the `Router` class depending on what method (get or post) you want to use.\
The following is the very basic syntax for executing a controller method:

- get(`@param` $route, `@param` $callback)
    - $route `string` The requested route
    - $callback `array` The array containing class and method name
        - `@param` The name of class to trigger written as namespace
        - `@param` The name of method to trigger written as string
        ```php
        <?php
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
        <?php
        ...
        $app->router->get("/", [src\controllers\MainController::class, "postUserInfo"]);
        ...
        $app->run();
        ```

---

### Create a Controller for GET/POST requests
In the example above i just mentioned a controller class and its method name, so now you have to create a new one with the same name and a public method with the same method name:

```php
<?php
...
namespace src\controllers;

use app\controllers\Application;

class MainController extends Application {

    public function getUserInfo() {
        $arrData["userinfo"] = [
            "fname" => "Thomas",
            "lname" => "A.Anderson",
            "job"   => "Software Engineer",
            "movie" => "The Matrix"
        ];

        $this->render("src/views/main.php", $arrData);
    }

    public function postUserInfo() {
        ...
        $arrData["submitted"] = $this->request->post();
        $this->render("src/views/contact.php", $arrData);
    }

}
```

The steps to follow when creating a new controller class are the following:
- Add the `namespace` where the actual controller is located
- Use the `Application` controller provided by Gramble
- Create a class with the same name mentioned in `index.php` and extend the `Application` controller
- Create a method with the same name mentioned in `index.php`


**NOTE**: For *post* methods, gramble provides a simple utility function that sanitizes data from malicious characters and this is accomplished by calling `$this->request->post()` method.

> Both method functions should return a view to be rendered.

---

### Passing data into the view
Now that you've mentioned a view path inside the render function, you need to create a new one.\
Inside `src/views/main.php` add the following lines:

```php
<h1>This is the Main Page</h1>
<span style="font-size: 18px">My name is <?= $userinfo["fname"] ?> <?= $userinfo["lname"] ?></span><br>
<span style="font-size: 10px">Im a <?= $userinfo["job"] ?> in <?= $userinfo["movie"] ?> movie</span>
```

Now open your browser at [localhost:5000](http://localhost:5000) and you will see this content in form of clean html.

<br />

## Layouts
Layouts have a relevant importance, as they can include a layout each time a page is loaded without having to write it in each view file.\
To accomplish this work, Gramble comes in with a basic template for including a `base` layout that is mentioned inside `app\libraries\Config` file as a string path:

```php
<?php
...
class Config {
    ...
    public string $base = "/app/views/base.html";
    ...
}
```

Let's take a look at this view:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/%LINK%.css"/>
    <title>%TITLE%</title>
</head>
<body>
    <div class="inner-content">%CONTENT%</div>
    <footer class="inner-footer">%FOOTER%</div>
    <script type="text/javascript" src="/assets/js/base.js"></script>
    <script type="text/javascript" src="/assets/js/%SCRIPT%.js"></script>
</body>
</html>
```

Notice the words surrounded by the `%` symbol, these will be replaced with the respective values:
- `%LINK%` and `%SCRIPT%` will be replaced with the absolute route name, this means that if the `/user/profile/settings` route is requested, only the `settings` route name should be taken, so you should create a new file for both css and js with the previous route name\
**NOTE**: If the given route name is located inside a sub directory, gramble will execute a parsing function inside the `css` and `js` folder to find this one and eventually will return the correct path, just be aware to not create multiple files with the same name
- `%TITLE` will be replaced with the absolute route name as well, but with the first letter in uppercase
- `%CONTENT%` will be replaced with the rendered view that you passed in using `$app->render()` function, to be clear the content of the previous **src/views/main.html** file
- `%FOOTER%` will be replaced eventually with the view given in the `config` class

> The base view is also fully customizable, but make sure to include these special characters in it so you don't run into problems.

<br />

Now let's say you want to add a custom template for the `footer` section, which is not provided by Gramble, so you just will need it (i guess).\
The next step is to add the following line inside `app\libraries\Config` class which takes the **relative** path of the footer view:

```php
<?php
...
class Config {
    ...
    public string $footer = "/app/views/footer.html";
    ...
}
```

> By Gramble v0.1.0 the only available and customizable templates variable are **$base**, **$footer**, **$error** which are respectively the base, the footer and the error (404) view.

<br />

## Syntax
For better readability the main conventions syntax to use inside views file are the following:
- Use the shortcut `<?= $variable ?>` instead of `<?php echo $variable ?>`
- Avoid the semicolon `;` when the expression is about to be closed as in the example above
- All the controlling structures and loops should be written as in the examples below

    - `if/elseif/else` statements
    ```php
    <?php if ($variable === true): ?>
        <span>The given variable is true</span><br>
    <?php elseif ($variable === false): ?>
        <span>The given variable is false</span><br>
    <?php else ?>
        <span>The given variable has type of <?= gettype($variable) ?></span><br>
    <?php endif ?>
    ```

    - `for` loops
    ```php
    <?php for ($i = 0; $i < 5; $i++): ?>
        <span><?= $i ?></span><br>
    <?php endfor ?>
    ```

    - `foreach` loops
    ```php
    <?php foreach (["hi,", "how", "are", "you?"] as $index): ?>
        <span><?= $index ?>&nbsp;</span>
    <?php endforeach ?>
    ```

    - `while` loops
    ```php
    <?php while ($variable === true): ?>
        <span><?= $variable ?></span><br>
    <?php endwhile ?>
    ```

    - `switch` statements
    ```php
    <?php switch ($variable): ?>
    <?php case true: ?>
        <span>The given variable is true</span><br>
    <?php case false: ?>
        <span>The given variable is false</span><br>
    <?php default: ?>
        <span>The given variable is <?= gettype($variable) ?></span><br>
    <?php endswitch ?>
    ```

> For more information visit [Control Structures Alternative Syntax](https://www.php.net/manual/en/control-structures.alternative-syntax.php#control-structures.alternative-syntax).

<br />

## License

### The MIT License (MIT)

#### Copyright © 2021 sampixel

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

<br />

## Changelog
- **v0.1.0** - *beta release*:
    - fixes route name by removing/adding slashes from user input
    - autoloader function to automate the required classes
    - support for both `get` and `post` requests
    - support for parsing css/js files inside folders (one level deep)
    - enable passing data from controller to view
    - enable templates for `base`, `footer`, `error` views
    - enable custom `layout` extension instead of `base`