<?php
namespace sync;
class ProductBuilder {

    private $id;
    private $product;
    private $name;
    private $shortDescription;
    private $longDescription;
    private $price;
    private $category;
    private $itemNumber;
    protected $categoryArray;

    public function __construct() {
        
    }

    public function id($id) {
        $this->id = $id;
        return $this;
    }

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function longDescription($longDescription) {
        $this->longDescription = $longDescription;
        return $this;
    }

    public function shortDescription($shortDescription) {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    public function price($price) {
        $this->price = $price;
        return $this;
    }

    public function category($category) {
        $this->category = $category;
        return $this;
    }

    public function itemNumber($itemNumber) {
        $this->itemNumber = $itemNumber;
        return $this;
    }
    public function categoryArray($categoryArray) {
        $this->categoryArray = $categoryArray;
        return $this;
    }

    public function build() {
        return new Product($this);
    }

    public function getCategory() {
        return $this->category;
    }

    public function getItemNumber() {
        return $this->itemNumber;
    }

    public function getLongDescription() {
        return $this->longDescription;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getShortDescription() {
        return $this->shortDescription;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getCategoryArray() {
        return $this->categoryArray;
    }

}
