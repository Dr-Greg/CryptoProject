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

function setE()
{
    echo "\nPlease enter two prime number between them E and M\n";
    echo "E must be greater than 1 and smaller than M\n";
    readline_clear_history();
    $line = readline("\nEnter your first number E: ");
    $line = str_replace(" ", "", $line);
    $line = (int)$line;

    if (is_numeric($line) && $line > 1)
        return $line;
    else {
        echo "\n***Value is not a number\n";
        setE();
    }
}

function setM($mLimit)
{
    echo "\nM must be greater than the sum of your secret sequence that is currently equal to " . strval($mLimit) . ".\n";
    readline_clear_history();
    $line = readline("\nEnter your second number M: ");
    $line = str_replace(" ", "", $line);
    $line = (int)$line;
    if (is_numeric($line)) {
        if ($line > $mLimit) {
            if ($line / 1 == $line || $line / $line == 1)
                return $line;
            else
                echo "\nYour number is not a prime number\n";
                setM($mLimit);
        } else {
            echo "\n M can not be lower or equal to " . $mLimit . "\n";
            setM($mLimit);
        }
    } else {
        echo "\n***Value is not a number\n";
        setM($mLimit);
    }
}

function setEM($mLimit)
{
    echo "\nPlease enter two prime number between them E and M\n";
    echo "E must be greater than 1 and smaller than M\n";
    $em = array();
    $line = readline("\nEnter your first number E: ");
    $line = str_replace(" ", "", $line);
    $line = (int)$line;

    if (is_numeric($line) && $line > 1)
        $em[0] = $line;
    else {
        echo "\n***Value is not a number\n";
        setEM($mLimit);
    }
    echo "M must be greater than the sum of your secret sequence that is currently equal to " . strval($mLimit) . ".\n";
    $line = readline("\nEnter your second number M: ");
    $line = str_replace(" ", "", $line);
    $line = (int)$line;
    if (is_numeric($line) && $line > $mLimit) {
        if ($line / 1 == $line || $line / $line == 1)
            $em[1] = $line;
        else
            echo "Your number is not a prime number\n";
    } else {
        echo "Value is not a number\n";
        setEM($mLimit);
    }
    return $em;
}
