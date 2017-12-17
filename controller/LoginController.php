<?php

namespace controller;

use model\Login;
use view\LoginView;
use config\Config;

class LoginController extends Controller {

    public function __construct($model) {
        $this->model = $model;
    }

    public function getLogin() {
        return $this->model->getLogin();
    }

    public function login() {
        $model = new Login();
        $this->model = $model;
        $view = new LoginView($this, $model);
        echo $view->output();
    }

    public function logout() {
        session_destroy();
        header('Location: ' . Config::create()->getRoot());
    }

}
