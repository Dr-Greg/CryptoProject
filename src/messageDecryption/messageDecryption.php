<?php

function messageDecryption($message, $n) {

}

function d($E, $M) {
    return my_inv_modulo($E, $M);
}

function permutationSecretKey($privateKey, $permutation) {
    for ($i=0; $i < sizeof($permutation) ; $i++) { 
        $privateKey2[$permutation[$i]] = $privateKey[$i];
    }
    ksort($privateKey2);
    return $privateKey2;
}

function decryptionPart1($messageEncrypt, $d, $M) {
    $newMessageEncrypt = array();
    $messageEncrypt = explode(" ", $messageEncrypt);
    foreach ($messageEncrypt as $value) {
        $valueB = my_modulo(($value * $d), $M);
        array_push($newMessageEncrypt, $valueB);
    }
    return $newMessageEncrypt;
}

function combineTerms($privateKey, $newMessageEncrypt) 
{
    $combineTerms = array();
    $messageDecryptionTerms = array();
    for ($i = 0; $i < sizeof($newMessageEncrypt); $i++) 
    { 
        $tmp = $newMessageEncrypt[$i];
        for ($j = sizeof($privateKey) - 1; $j >= 0; $j--) 
        {
            if (($tmp - $privateKey[$j]) >= 0) 
            {
                $tmp = $tmp - $privateKey[$j];
                array_push($combineTerms, $privateKey[$j]); 
            }
        }
        $messageDecryptionTerms[$newMessageEncrypt[$i]] = $combineTerms;
        $combineTerms = array();
    }
    return $messageDecryptionTerms;
}

function _secretKeyToBinary($privateKey2, $n)
{
    $privateKeyToBinary = array();
    $binary = "";

    for ($i = 1; $i < sizeof($privateKey2) && $i <= $n; $i++) { 
        $privateKeyToBinary[$privateKey2[$i]] = str_pad($binary, $n - $i, "0");
        $privateKeyToBinary[$privateKey2[$i]] .= "1";
        $privateKeyToBinary[$privateKey2[$i]] = str_pad($privateKeyToBinary[$privateKey2[$i]], $n, "0");
    }
    return $privateKeyToBinary;
}

function _messageToBinary($messageDecryptionTerms, $privateKeyToBinary, $newMessageEncrypt, $n) {
    $messageToBinary = array();
    foreach ($newMessageEncrypt as $value) {
        $binary = "";
        for ($i = 0; $i < sizeof($messageDecryptionTerms[$value]); $i++) { 
            $binary += $privateKeyToBinary[$messageDecryptionTerms[$value][$i]];
        }
        $binary = str_pad($binary, $n, "0", STR_PAD_LEFT);
        array_push($messageToBinary, $binary);
    }
    $messageToBinary = implode("", $messageToBinary);
    return $messageToBinary;
}

function _binaryToText($messageToBinary){
    $messageToBinary = str_split($messageToBinary, 8);
    if (strlen($messageToBinary[count($messageToBinary) - 1]) < 8)
        array_pop($messageToBinary);
    $text = array();
    for($i=0; count($messageToBinary)>$i; $i++)
        $text[] = chr(bindec($messageToBinary[$i]));
        
    return implode($text);
}
