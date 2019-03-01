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
    $publicKeySort = $publicKey;
    sort($publicKeySort);
    for ($i=0; $i < sizeof($publicKey); $i++) { 
      for ($j=0; $j < sizeof($publicKeySort); $j++) { 
        if ($publicKey[$i] == $publicKeySort[$j])
          array_push($permutation, $j+1);
      }
    }
    $publicKeyString = implode(", ", $publicKeySort);
    $permutationString = implode(", ", $permutation);
    printRecapKey($privateKey, $E, $M, $publicKeyString, $permutationString);   
}

function printRecapKey($privateKey, $E, $M, $publicKeyString, $permutationString) 
{
  $privateKeyString = implode(", ", $privateKey);
  echo "\n************************ Your part *****************************\n";
  echo "      Here is all the information about your secret key :       \n";
  echo "      Your secret key is : " . $privateKeyString . "               \n";
  echo "      The permutation is : " . $permutationString . "               ";
  echo "\n****************************************************************\n\n";
  echo "\nThe numbers you have chosen are: E = " . $E . " and M = " . $M . "  \n\n";
  echo "******************** The part to be shared *********************\n";
  echo "Your public key to share : " . $publicKeyString . "  \n\n";
}
