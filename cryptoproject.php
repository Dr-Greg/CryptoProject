<?php

include_once('src/menu/menu.php');
include_once('src/generateKeys/privateKey.php');
include_once('src/generateKeys/publicKey.php');
include_once('src/utils/utils.php');
include_once('src/messageDecryption/messageDecryption.php');
include_once('src/messageEncryption/encryptMessage.php');

function generateKeys()
{
    $privateKey = createSecretKey();
    $mLimit = 0;
    foreach ($privateKey as $key) {
        $mLimit += $key;
    }
    $e = setE();
    if ($e == -1)
        return;
    $m = setM($mLimit);
    if ($e == -1)
        return;
    generatePublicKey($privateKey, $e, $m);
}

function main()
{
    $isRunning = true;
    $firstRun = true;

    printMenu();

    while ($isRunning) {
        if (!$firstRun)
            printSecondaryMenu();
        $line = readline("\nEnter your choice from 1 to 4: ");

        switch ($line) {
            case "1" :
                generateKeys();
                break;
            case "2" :
                encryptMessage();
                break;
            case "3" :
                messageDecryption();
                break;
            case "4" :
                echo "\nSee you next time. Bye !\n";
                $isRunning = false;
                break;
            default:
                echo "\n*** Invalid selection\n";
                break;
        }
        $firstRun = false;
    }
}

main();