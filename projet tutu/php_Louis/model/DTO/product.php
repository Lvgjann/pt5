<?php
// include_once "modeles/traits/hydrate.php";

class Product {
    use Hydrate;
    private $parkod10;

    public function __construct($parkod10 =null){
        $this->parkod10 = $parkod10;
    }

    public function getParkod10(){
        return $this->parkod10;
    }


}