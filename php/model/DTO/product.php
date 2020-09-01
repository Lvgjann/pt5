<?php
// include_once "modeles/traits/hydrate.php";

class Product {
    use Hydrate;
    private $parkod10;
    private $idcomportement;

    public function __construct($parkod10 =null,$idcomportement = null){
        $this->parkod10 = $parkod10;
        $this->idcomportement = $idcomportement;
    }

    public function getParkod10(){
        return $this->parkod10;
    }
    
    public function setParkod10($parkod10){
        $this->parkod10 = $parkod10;
    }

    public function getIdComportement(){
        return $this->idcomportement;
    }
    
    public function setIdcomportement($idcomportement){
        $this->idcomportement = $idcomportement;
    }

}