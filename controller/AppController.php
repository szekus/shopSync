<?php

namespace controller;

class AppController extends Controller {

    public function __construct($model) {
        parent::__construct($model);
    }

    public static function create() {
        return new AppController(NULL);
    }

    public function run() {
        include DOCUMENT_ROOT . '/view/templates/main.php';
    }

}
