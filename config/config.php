<?php

namespace config;

class Config {

    const APP_NAME = "shopSync";

    private $ROOT;
    private $DOCUMENT_ROOT;
    
    const DS = DIRECTORY_SEPARATOR;

    const HOST = 'johnny.heliohost.org';
    const USER = 'szekus_root';
    const PASSWORD = 'admin';
    const DATABASE = 'szekus_shopSync';

    public function __construct() {
        ;
    }

    public static function create() {
        $config = new Config();


        $appRoot = 'http://' . $_SERVER['SERVER_NAME'] . self::DS . self::APP_NAME . self::DS;
        $config->ROOT = $appRoot;
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $config->DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . self::DS . self::APP_NAME . self::DS;

        return $config;
    }

    function getRoot() {
        return $this->ROOT;
    }
    
    function getDocumentRoot(){
        return $this->DOCUMENT_ROOT;
    }

}
