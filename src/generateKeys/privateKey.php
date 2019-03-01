<?php

function isSuperIncreasing($privateKey)
{
    $total = 0;
    $test = true;

    foreach ($privateKey as $key) {
        if ($key < $total) {
            $test = false;
            break;
        }
        $total += $key;
    }
    return $test;
}

function createSecretKey()
{
    $result = array();

    echo "\nFor the secret key, please enter a number sequence separated by commas with more then 2 values.\n\n";
    echo "The sequence you enter must be superincresing.\nA sequence is called superincreasing if \nevery element of the sequence is greater \nthan the sum of all previous elements in the sequence. \n\nExemple : 1, 2, 5, 10, 20, 50 \n\n";
    $line = readline("Enter your list of number: ");
    $privateKey = explode(",", str_replace(" ", "", $line));

    if (count($privateKey) > 2) {

        foreach ($privateKey as $key) {
            array_push($result, (int)$key);
        }

        if (isSuperIncreasing($result))
            return $result;
    }
    echo "\n *** Please enter only a super increasing numerical sequence with more then 2 values.\n";
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
    echo "M must be greater than the sum of your secret sequence that is currently equal to " . (int)$tmpValue . " .";
    $line = readline("Enter your second number M: ");
    trim($line);
    if (is_numeric((int)$line) && $line > $tmpValue) {
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

$privateKey = createSecretKey();






