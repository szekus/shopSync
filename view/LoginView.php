<?php

namespace view;

class LoginView extends View {

    public function __construct($controller, $model) {
        parent::__construct($controller, $model);
    }

    public function output() {
        include DOCUMENT_ROOT .'view/templates/loginForm.php';
    }

}
