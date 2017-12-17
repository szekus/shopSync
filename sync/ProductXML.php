<?php

namespace sync;

use DOMDocument;

class ProductXML {

    private $dom;
    private $products;
    private $categories;

    public function __construct() {
        $this->dom = new DomDocument('1.0', 'iso-8859-2');
        $this->products = $this->dom->appendChild($this->dom->createElement('products'));
    }

    public function addCategoriy($categoryObject) {
        $categoryNode = $this->categories->appendChild($this->dom->createElement('category'));
        $categoryNode->appendChild(
                $this->dom->createTextNode($categoryObject->getName()));
    }

    public function appendNode($productObject) {

        $product = $this->products->appendChild($this->dom->createElement('product'));
        $name = $product->appendChild($this->dom->createElement('name'));
        $shortDescription = $product->appendChild($this->dom->createElement('shortDescription'));
        $longDescription = $product->appendChild($this->dom->createElement('longDescription'));
        $price = $product->appendChild($this->dom->createElement('price'));
        $this->categories = $product->appendChild($this->dom->createElement('categories'));

        foreach ($productObject->getCategoryArray() as $categoryObject) {

            $this->addCategoriy($categoryObject);
        }
        $itemNumber = $product->appendChild($this->dom->createElement('itemNumber'));

//        $category = $product->appendChild($this->dom->createElement('category'));
//        $category->appendChild(
//                $this->dom->createTextNode($productObject->getCategory()));

        
        $name->appendChild(
                $this->dom->createTextNode($productObject->getName()));
        $shortDescription->appendChild(
                $this->dom->createTextNode($productObject->getShortDescription()));
        $longDescription->appendChild(
                $this->dom->createTextNode($productObject->getLongDescription()));
        $price->appendChild(
                $this->dom->createTextNode($productObject->getPrice()));

        $itemNumber->appendChild(
                $this->dom->createTextNode($productObject->getItemNumber()));
    }

    public function save() {
        $this->dom->formatOutput = true;
        $document = $this->dom->saveXML();

        $this->dom->save('products.xml');
    }

}
