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
    $publicKey = explode(",",trim($userInputPublicKey));
    $blockLength = (int)readline("Now you have to enter the number N between 4 and 8: ");
    if ($blockLength < 4 || $blockLength > 8) {
        echo "\n *** An integer between 4 and 8 is expected. ***\n";
        echo " ***             Please start again             ***\n\n";
        return;
    }
    $binMessage = _textToBinary($message);
    $explodedMessage = _explodeMessage($binMessage, $blockLength);
    echo "\nYour message has been encrypted.\n";
    echo "You can now send it to your recipients.\n";
    echo "Don't forget to send your public key, otherwise they won't be able to read your message :)\n\n";
    echo "Message : " . _encryptMessage($publicKey, $blockLength, $explodedMessage);
    echo "Public Key : ";
    for ($i = 0; $i < count($publicKey); $i++) {
        echo $publicKey[$i] . (($i + 1) >= count($publicKey) ? "\n" : ", ");
    }
    echo "Your number N : " . $blockLength . "\n\n";
}
