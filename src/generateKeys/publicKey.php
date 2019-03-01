<?php

include_once(__DIR__ . "/../utils/utils.php");

function generatePublicKey($privateKey, $E, $M) 
{
	$publicKey = array();
	$permutation = array();

    foreach ($privateKey as $value) {
    	$int = $value * $E;
      	$valueB = my_modulo($int, $M);
      	array_push($publicKey, $valueB);
    }

    $publicKeySort = sort($publicKey);

    for ($i=0; $i < sizeof($publicKey); $i++) { 
    	for ($j=0; $j < sizeof($publicKeySort); $j++) { 
    		if ($publicKey[$i] == $publicKeySort[$j])
    		{
    			array_push($permutation, $j+1);
    		}
    	}
   	}
   	$myPublicKey = implode(", ", $publicKeySort);
   	$myPermutation = implode(", ", $permutation);
}
