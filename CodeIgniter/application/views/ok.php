<?php
echo "ca marche</br></br>";

$liste[] = 1;
$liste[] = 2;
$liste[] = 3;
$liste[] = 4;

$liste2[] = 1;
$liste2[] = 4;
$liste2[] = 8;

$result = array_intersect($liste, $liste2);

print_r($result);
?>