<?php

function isSuperIncreasing($privateKey)
{
    $result = array();
    $total = 0;
    $test = true;

    foreach ($privateKey as $key) {
        array_push($result, (int)$key);
    }

    foreach ($result as $key) {
        if ($key < $total) {
            $test = false;
            break;
        }
        $total += $key;
    }
    return $result;
}

function createSecretKey()
{
    echo "\nFor the secret key, please enter a number sequence separated by commas.\n\n";
    echo "The sequence you enter must be superincresing.\nA sequence is called superincreasing if \nevery element of the sequence is greater \nthan the sum of all previous elements in the sequence. \n\nExemple : 1, 2, 5, 10, 20, 50 \n\n";
    $line = readline("Enter your list of number: ");
    $privateKey = explode(",", str_replace(" ", "", $line));
    if (isSuperIncreasing($privateKey))
        return $privateKey;
    echo "Please enter only a super increasing numerical sequence.\n";
    createSecretKey();
}

function setEM($tmpValue)
{
    echo "Please enter two prime number between them E and M\n";
    echo "E must be greater than 1 and smaller than M\n";
    $line = readline("Enter your first number E: ");
    $em = array();

    trim($line);

    if (is_numeric((int)$line) && $line > 1)
        $em[0] = $line;
    else {
        echo "Value is not a number\n";
        setEM($tmpValue);
    }
    echo "M must be greater than the sum of your secret sequence that is currently equal to " . (Integer)$tmpValue . " .";
    $line = readline("Enter your second number M: ");
    trim($line);
    if (is_numeric((Integer)$line) && $line > $tmpValue) {
        if ($line / 1 == $line || $line / $line == 1)
            $em[1] = $line;
        else
            echo "Your number is not a prime number\n";
    } else {
        echo "Value is not a number\n";
        setEM($tmpValue);
    }
    return $em;
}

createSecretKey();