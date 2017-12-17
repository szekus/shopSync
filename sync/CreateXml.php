<?php

namespace sync;

use sync\ProductInfo;
use sync\ProductXML;

class CreateXML {

    public function __construct() {
        ;
    }

    public function create() {
        $productInfo = new ProductInfo();
        $productInfo->setProductsArray();
        $array = $productInfo->getProductArray();
        $xml = new ProductXML();

        foreach ($array as $value) {
            $xml->appendNode($value);
        }

        $xml->save();
    }

}
