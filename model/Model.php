<?php

namespace model;
use lib\database\Database;

class Model {

    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function save(){}
}
