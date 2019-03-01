<?php

function _textToBinary($message)
{
    $binMessage = "";

    for ($i = 0; $i < strlen($message); $i++) {
        $char = $message[$i];
        $byte = strval(decbin(ord($char)));

        while (strlen($byte) < 8)
            $byte = "0" . $byte;

        $binMessage .= $byte;
    }
    return $binMessage;
}


function _explodeMessage($binMessage, $blockLength)
{
    $explode = str_split($binMessage, $blockLength);
    $lastByte = $explode[count($explode) - 1];

    while (strlen($lastByte) < $blockLength)
        $lastByte = $lastByte . "0";

    $explode[count($explode) - 1] = $lastByte;
    return $explode;
}


function _encryptMessage($publicKey, $blockLength, $explodedMessage)
{
    $equiValue = array();
    $encryptedMessage = "";

    for ($i = 0; $i < count($publicKey); $i++)
        if ($blockLength > 0)
            $equiValue[$blockLength-- - 1] = $publicKey[$i];

    for ($i = 0; $i < count($explodedMessage); $i++) {
        $encryptedBlock = 0;

        for ($j = 0; $j < strlen($explodedMessage[$i]); $j++)
            if ($explodedMessage[$i][$j] == 1)
                $encryptedBlock += $equiValue[$j];

        $encryptedMessage .= $encryptedBlock . (($i + 1) >= count($explodedMessage) ? "\n" : " ");
    }
    return $encryptedMessage;
}


function encryptMessage()
{
    $message = readline("Enter the message to encrypt : ");
    $userInputPublicKey = readline("Enter the public key of recipient : ");
    $blockLength = readline("Now you have to enter a number beetwin 4 and 8: ");
    $publicKey = explode(",",trim($userInputPublicKey));
    $binMessage = _textToBinary($message);
    $explodedMessage = _explodeMessage($binMessage, $blockLength);
    echo "\nYour message has been encrypted.\n";
    echo "You can now send it to your recipients.\n";
    echo "Don't forget to send your public key, otherwise they won't be able to read your message :)\n\n";
    echo "Message : " . _encryptMessage($publicKey, $blockLength, $explodedMessage);
    echo "Public Key : ";
    for ($i = 0; $i < count($publicKey); $i++) {
        echo $publicKey[$i] . (($i + 1) >= count($publicKey) ? "\n\n" : ", ");
    }
}

//encryptMessage("PREPETNA", array(251, 255, 312, 412, 462, 492, 502, 510), 6);