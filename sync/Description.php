<?php
namespace sync;
class Description {

    private $short;
    private $long;
    private $name;

    public function __construct() {
        ;
    }

    public function setShort($short) {
        $this->short = $short;
    }

    public function setLong($long) {
        $this->long = $long;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getShort() {
        return $this->short;
    }

    public function getLong() {
        return $this->long;
    }

    public function getName() {
        return $this->name;
    }

}
