<?php

include_once('src/menu/menu.php');
include_once('src/generateKeys/privateKey.php');
include_once('src/generateKeys/publicKey.php');
include_once('src/utils/utils.php');
include_once('src/messageDecryption/messageDecryption.php');
include_once('src/messageEncryption/encryptMessage.php');

function main()
{
    $isRunning = true;

    printMenu();

    while ($isRunning) {
        $line = readline("Enter your choice from 1 to 4: ");

        switch ($line) {
            case "1" :
                break;
            case "2" :
                encryptMessage("PREPETNA", array(251, 255, 312, 412, 462, 492, 502, 510), 6);
                break;
            case "3" :
                break;
            case "4" :
                echo "See you next time. Bye !";
                $isRunning = false;
                break;
            default:
                echo "Invalid selection";
                break;
        }
    }
}

main();


/*$privateKey = array('1', '2', '5', '10', '20', '50', '100', '200');
$permutation = array('2', '8', '1', '7', '6', '5', '4', '3');
$E = 255;
$M = 512;
$d = d($E, $M);
$messageEncrypt = "774 563 663 563 774 312 1025 774 968 804 312";
$newMesssageEncrypt = decryptionPart1($messageEncrypt, $d, $M);
$privateKey2 = permutationSecretKey($privateKey, $permutation);
combineTerms($privateKey, $newMesssageEncrypt);




//var_dump(permutationSecretKey($privateKey, $permutation));
//var_dump(decryptionPart1($messageEncrypt, $d, $M));

/*while (true) {
    printMenu();
    $line = readline("Enter your choice from 1 to 4: ");

    if ($line == "1")
        createSecretKey();
    else if ($line == "2")
        echo "Invalid selection";
    else if ($line == "3")
        echo "Invalid selection";
    else if ($line == "4")
        break;
    else
        echo "Invalid selection";
}*/