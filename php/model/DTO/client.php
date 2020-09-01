<?php
// include_once "modeles/traits/hydrate.php";

class Client{
    use Hydrate;
    private $cartefid;

    public function __construct($cartefid =null){
        $this->cartefid = $cartefid;
    }

    public function getCarteFid(){
        return $this->cartefid;
    }

    public function setCartefid($cartefid){
        $this->cartefid = $cartefid;
    }

}