<?php
namespace model;
class User extends Model {

    private $id;
    private $userName;
    private $password;

    public function __construct() {
        parent::__construct();
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
    
    public function isUser(){
        return false;
    }
}
