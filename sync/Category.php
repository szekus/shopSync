<?php
namespace sync;
class Category {

    private $name;

    public function __construct() {
        
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }

}
