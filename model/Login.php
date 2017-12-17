<?php

namespace model;
use PDO;

class Login extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getLogin() {

        $userName = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
        if (isset($userName) && isset($password)) {
            $password = md5($password);
            $array = array("username" => $userName, "password" => $password);

            $query = "SELECT id FROM user WHERE username = :username AND password = :password ";
            $result = $this->db->select($query, $array, PDO::FETCH_ASSOC);
            
            if (count($result) > 0) {
                return $result[0]["id"];
            } else {
                return -1;
            }
        }
    }

//    public function login() {
//        return false;
//    }

}
