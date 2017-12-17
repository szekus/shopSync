<?php
namespace sync;
class Product {

    protected $id;
    protected $name;
    protected $shortDescription;
    protected $longDescription;
    protected $price;
    protected $category;
    protected $itemNumber;
    protected $categorieArray;

//    public static function create($productBuilder) {
//        $product = new Product();
//        $product->id = $productBuilder->getId();
//        $product->name = $productBuilder->getName();
//        $product->shortDescription = $productBuilder->getShortDescription();
//        $product->longDescription = $productBuilder->getLongDescription();
//        $product->price = $productBuilder->getPrice();
//        $product->category = $productBuilder->getCategory();
//        $product->itemNumber = $productBuilder->getItemNumber();
//
//        return $this;
//    }

    function __construct($productBuilder) {
        $this->id = $productBuilder->getId();
        $this->name = $productBuilder->getName();
        $this->shortDescription = $productBuilder->getShortDescription();
        $this->longDescription = $productBuilder->getLongDescription();
        $this->price = $productBuilder->getPrice();
        $this->category = $productBuilder->getCategory();
        $this->itemNumber = $productBuilder->getItemNumber();
        $this->categorieArray = $productBuilder->getCategoryArray();
    }

    public function getName() {
        return $this->name;
    }

    public function getShortDescription() {
        return $this->shortDescription;
    }

    public function getLongDescription() {
        return $this->longDescription;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getItemNumber() {
        return $this->itemNumber;
    }

    public function getCategoryArray() {
        return $this->categorieArray;
    }
    
}
