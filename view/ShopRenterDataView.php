<?php

namespace view;

class ShopRenterDataView extends View {

    public function __construct($controller, $model) {
        parent::__construct($controller, $model);
    }

    public function output() {
        include DOCUMENT_ROOT .'view/templates/shopRenterDataForm.php';
    }

}
