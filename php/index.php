<?php

require 'lib/autoload.php';
session_start();
$chrono_start = microtime(true);
productDAO::cleanTraProduit();
// $parkod = productDAO::selectMostConsumeProduct('9990222149957');
$parkod = productDAO::selectMostConsumeProduct('9990200130465');

if ($parkod != null){
    $test = clientDAO::selectSpeCli($parkod);
    $idComport = productDAO::getIdComportement($parkod);
    var_dump(' TEST '.$idComport);
    productDAO::iniTraProduit($test,$parkod,$idComport,2,2);
    $finalTest = productDAO::mostConsumeProduct();
    var_dump($finalTest);
}
else {
    echo "Ce client n'a pas de vente en bdd"."\n";
}
$chrono_end = microtime(true);
$duree =  $chrono_end - $chrono_start;
echo 'DUREE DU TRAITEMENT : '.$duree;

clientDAO::iniClientNoel();

