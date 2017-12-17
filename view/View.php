<?php

namespace view;

class View {

    private $model;
    private $controller;
    private $template;

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output() {
    }
    
    public function getModel() {
        return $this->model;
    }
    
    public function errorPage(){
        include DOCUMENT_ROOT .'view/templates/error.php';
    }

}
