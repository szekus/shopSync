<?php

namespace sync;

//require_once dirname(__FILE__) . '/../lib/shopRenterApi/classes/apicall.php';

class ProductInfo {

    const USERNAME = 'test';
    const API_KEY = '2dcd07ef6f3515a5f3a00daba7967fb6';
    const API_URL = "leitzteszt4.api.shoprenter.hu";
    const LIMIT = 20;

    private $response;
    private $apiCall;
    private $productUrl;
    private $descriptionUrl;
    private $categoryUrl;
    private $products;

    public function __construct() {
        $this->apiCall = new \lib\shopRenterApi\classes\ApiCall(self::USERNAME, self::API_KEY);
        $this->apiCall->setFormat('json');
        $this->productUrl = self::API_URL . '/products/';
        $this->descriptionUrl = self::API_URL . '/productDescriptions/';
        $this->categoryUrl = self::API_URL . '/productCategoryRelations/';
    }

    function getProductLinks() {
        $url = $this->productUrl . '?page=0&limit=' . self::LIMIT;
        $response = $this->apiCall->execute('GET', $url);
        $array = $response->getParsedResponseBody();
        $items = $array["items"];
        return $items;
    }

    function getIds() {
        $productLinks = $this->getProductLinks();
        $productUrls = array();
        foreach ($productLinks as $key => $value) {
            $productUrls[] = Functions::getUrlFromLink($value["href"]);
        }
        $productIds = array();
        foreach ($productUrls as $itemUrl) {
            $productIds[] = Functions::getIdFromUrl($this->productUrl, $itemUrl);
        }
        return $productIds;
    }

    function getPriceById($productId) {
        return $this->getItemInfoById($productId)["price"];
    }

    function getSkuById($productId) {
        return $this->getItemInfoById($productId)["sku"];
    }

    function getOrderable($productId) {
        return $this->getItemInfoById($productId)["orderable"];
    }

    function getStatus($productId) {
        return $this->getItemInfoById($productId)["status"];
    }

    function getDescriptionByProductId($productId) {
        $response = $this->apiCall->execute('GET', $this->descriptionUrl . "?productId=" . $productId);

        $descriptionHref = $response->getParsedResponseBody()["items"][0]["href"];
        $responseLink = Functions::getUrlFromLink($descriptionHref);
        $responseDescription = $this->apiCall->execute('GET', $responseLink);
        $description = new Description();
        $description->setShort($responseDescription->getParsedResponseBody()["shortDescription"]);
        $description->setLong($responseDescription->getParsedResponseBody()["description"]);
        $description->setName($responseDescription->getParsedResponseBody()["name"]);
        return $description;
    }

    function getCategoriesByCategoryRelations($productId) {
        $response = $this->apiCall->execute('GET', $this->categoryUrl . "?productId=" . $productId);
        $items = $response->getParsedResponseBody()["items"];

        $categories = array();
        foreach ($items as $item) {
            $url = Functions::getUrlFromLink($item["href"]);
            $response = $this->apiCall->execute('GET', $url);
            $categoryUrl = $response->getParsedResponseBody()["href"];
            $response = $this->apiCall->execute('GET', $categoryUrl);
            $url = $response->getParsedResponseBody()['category']["href"];
            $response = $this->apiCall->execute('GET', $url);
            $categoryDescriptionsLink = $response->getParsedResponseBody()["categoryDescriptions"]["href"];
            $url = Functions::getUrlFromLink($categoryDescriptionsLink);
            $response = $this->apiCall->execute('GET', $url);
            $categoryItems = $response->getParsedResponseBody()["items"];
            foreach ($categoryItems as $categoryItem) {
                $url = Functions::getUrlFromLink($categoryItem["href"]);
                $response = $this->apiCall->execute('GET', $url);
                $name = $response->getParsedResponseBody()["name"];
                $category = new Category();
                $category->setName($name);
                $categories[] = $category;
            }
        }
        return $categories;
    }

    public function setProductsArray() {
        $productIds = $this->getIds();
        
        foreach ($productIds as $productId) {
//            echo '<pre>';
//            print_r($this->getItemInfoById($productId));
            if ($this->getStatus($productId) == 1) {
                $description = $this->getDescriptionByProductId($productId);
                $categories = $this->getCategoriesByCategoryRelations($productId);

                $name = $description->getName();
                $shortDescription = $description->getShort();
                $longDescription = $description->getLong();
                $categoryString = Functions::convertCategoryArrayToString($categories);
                $price = $this->getPriceById($productId);
                $sku = $this->getSkuById($productId);

                $productBuilder = new ProductBuilder();
                $product = $productBuilder->
                        name($name)->
                        shortDescription($shortDescription)->
                        longDescription($longDescription)->
                        category($categoryString)->
                        price($price)->
                        itemNumber($sku)->
                        categoryArray($categories)->
                        build();
//            var_dump($product);
                $this->products[] = $product;
            }
        }
    }

    public function getInfo() {
        $response = $this->apiCall->execute('GET', $this->productUrl);
        print_r($response->getParsedResponseBody());

        return $response;
    }

    public function getItemInfoById($id) {
        $response = $this->apiCall->execute('GET', $this->productUrl . $id);
//        print_r($response->getParsedResponseBody());

        return $response->getParsedResponseBody();
    }

    public function getAllInfo() {
        $productIds = $this->getIds();
        foreach ($productIds as $productId) {
//            $this->getItemInfoById($productId);
            $this->getCategoriesByCategoryRelations($productId);
        }
    }

    public function getInfoByLink() {
        $url = "leitzteszt4.api.shoprenter.hu/categories/Y2F0ZWdvcnktY2F0ZWdvcnlfaWQ9MzI3";
        $response = $this->apiCall->execute('GET', $url);
        print_r($response->getParsedResponseBody());
    }

    public function getProductArray() {
        return $this->products;
    }

}
