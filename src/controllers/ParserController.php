<?php

namespace src\controllers;

use app\libraries\Parser;
use app\controllers\Application;

/**
 * Class ParserController
 */
class ParserController extends Application {

    /**
     * @var Parser $parser
     * The parser object
     */
    public Parser $parser;

    public function __construct() {
        $this->parser = new Parser;
    }

    public function parserIndex() {
        echo json_encode($file);
    }

}