<?php

require 'lib/autoload.php';
session_start();

echo("hello world !"."\n");

$test = clientDAO::selectSpeCli('00A67E1B20');
productDAO::iniTraProduit($test, '00A67E1B20',2,2);
$finalTest = productDAO::mostConsumeProduct();
var_dump($finalTest);

clientDAO::iniClientNoel();