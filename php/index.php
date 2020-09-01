<?php

require 'lib/autoload.php';
session_start();

$parkod = '00A67E1B20';

$test = clientDAO::selectSpeCli($parkod);
$idComport = productDAO::getIdComportement($parkod);
var_dump(' TEST '.$idComport);
productDAO::iniTraProduit($test,$parkod,$idComport,2,2);
$finalTest = productDAO::mostConsumeProduct();
var_dump($finalTest);

clientDAO::iniClientNoel();