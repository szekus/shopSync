<?php

namespace model;

class ShopRenterData extends Model {

    private $userId;
    private $userName;
    private $apiKey;
    private $apiUrl;
    private $feedURl;

    public function __construct() {
        parent::__construct();
    }

    public function create($userId) {
        $shopRenterData = new ShopRenterData();
        $userId = $_SESSION["userId"];
        $query = "SELECT * FROM shopRenterData WHERE user_id = $userId";
//        echo $query;
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $shopRenterData->setUserName($result[0]["user_name"]);
            $shopRenterData->setApiKey($result[0]["api_key"]);
            $shopRenterData->setApiUrl($result[0]["api_url"]);
            $shopRenterData->setFeedUrl($result[0]["feed_url"]);
        }

        return $shopRenterData;
//        print_r($result[0]);
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getApiKey() {
        return $this->apiKey;
    }

    public function setApiUrl($apiUrl) {
        $this->apiUrl = $apiUrl;
    }

    public function getApiUrl() {
        return $this->apiUrl;
    }

    public function setFeedUrl($feedUrl) {
        $this->feedURl = $feedUrl;
    }

    public function getFeedUrl() {
        return $this->feedURl;
    }

    public function save() {
        $array = array("user_name" => $this->getUserName(),
            "api_url" => $this->getApiUrl(),
            "api_key" => $this->getApiKey(),
            "feed_url" => $this->getFeedUrl()
        );
        $this->db->update('shopRenterData', $array, 'user_id = ' . $_SESSION["userId"]);
    }

}
