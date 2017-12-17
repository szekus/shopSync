<?php

namespace lib\database;

use PDO;
use config\Config;

//require_once dirname(__FILE__) . '/../../config/config.php';

class Database extends PDO {

    static protected $db;

    public function __construct() {

        parent::__construct("mysql" . ":host=" . Config::HOST . "; dbname=" . Config::DATABASE, Config::USER, Config::PASSWORD, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));

//        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    }

    public static function getInstance() {
        if (!isset(self::$db)) {
            self::$db = new Database();
        }
        return self::$db;
    }

    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
//        echo $sql;
        try {
            $sth = $this->prepare($sql);
            foreach ($array as $key => $value) {
                $sth->bindValue(":$key", $value);
            }
            $sth->execute();
            return $sth->fetchAll();
        } catch (PDOException $ex) {
            echo "ERROR: " . $sql;
//            var_dump($ex);
        }
    }

    public function insert($table, $data) {
        ksort($data);
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)";
//        echo $sql;
        $sth = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
    }

    public function update($table, $data, $where) {
        ksort($data);
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key` = :$key,";
        }
        $fieldDetail = rtrim($fieldDetails, ',');
        $sth = $this->prepare("UPDATE $table SET $fieldDetail WHERE $where");
//        echo "UPDATE $table SET $fieldDetail WHERE $where";
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
    }

    public function delete($table, $where, $limit = 1) {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

    public function deleteAll($table, $where) {
        return $this->exec("DELETE FROM $table WHERE $where");
    }

}
