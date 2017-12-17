<?php

namespace sync;

use sync\ProductInfo;
use sync\ProductXML;
use Exception;

class CreateXML {

    private $userId;

    public function __construct() {
        ;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function create() {
        try {
            $productInfo = new ProductInfo($this->userId);
            $productInfo->setProductsArray();
            $array = $productInfo->getProductArray();
            $xml = new ProductXML();

            foreach ($array as $value) {
                $xml->appendNode($value);
            }
            $xml->save();
        } catch (Exception $exc) {
//            var_dump($exc);
//            echo $exc->getTraceAsString();
            echo "<pre>";
            echo $exc->getMessage();
            echo "</pre>";
        }
    }

}
