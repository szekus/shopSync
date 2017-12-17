<?php

namespace controller;

use model\ShopRenterData;
use view\ShopRenterDataView;

class IndexController extends Controller {

    public function __construct($model) {
        parent::__construct($model);
    }

    public function getLogin() {
        return $this->model->getLogin();
    }

    public function settings() {
//        if (isset($_SESSION["user_id"])) {
            $userId = $_SESSION["userId"];
            $shopRenterData = new ShopRenterData();
            $shopRenterData = $shopRenterData->create($userId);
//        $shopRenterData->create($this->user->getId());

            $userName = filter_input(INPUT_POST, "userName");
            $apiKey = filter_input(INPUT_POST, "apiKey");
            $apiUrl = filter_input(INPUT_POST, "apiUrl");

            if (isset($userName) && isset($apiKey) && isset($apiUrl)) {
                $shopRenterData->setUserName($userName);
                $shopRenterData->setApiKey($apiKey);
                $shopRenterData->setApiUrl($apiUrl);
                $shopRenterData->save();
            }

            $this->model = $shopRenterData;



            $view = new ShopRenterDataView($this, $shopRenterData);
            echo $view->output();
//        } 
    }

    public function saveSettings() {
        $this->model->save();
    }

}
