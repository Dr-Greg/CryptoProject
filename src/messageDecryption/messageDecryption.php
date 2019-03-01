<?php

include_once(__DIR__ . "/../utils/utils.php");

function d($E, $M)
{
    return my_inv_modulo($E, $M);
}

function permutationSecretKey($privateKey, $permutation)
{
    for ($i = 0; $i < sizeof($permutation); $i++) {
        $privateKey2[$permutation[$i]] = $privateKey[$i];
    }
    ksort($privateKey2);
    return $privateKey2;
}

function decryptionPart1($messageEncrypt, $d, $M)
{
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
    for ($i = 0; $i < sizeof($newMessageEncrypt); $i++) {
        $tmp = $newMessageEncrypt[$i];
        for ($j = sizeof($privateKey) - 1; $j >= 0; $j--) {
            if (($tmp - $privateKey[$j]) >= 0) {
                $tmp = $tmp - $privateKey[$j];
                array_push($combineTerms, $privateKey[$j]);
            }
        }
        $messageDecryptionTerms[$newMessageEncrypt[$i]] = $combineTerms;
        $combineTerms = array();
    }
    return $messageDecryptionTerms;
}

function decryptMessage($privateKey, $encryptedMessage, $perm, $blockLength, $e, $m)
{

}

//decryptMessage(array(1, 2, 5, 10, 20, 50, 100, 200), 6, "774 563 663 563 774 312 1025 774 968 804 312", array(2, 8, 1, 7, 6, 5, 4, 3), 255, 512);