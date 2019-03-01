<?php

function createSecretKey()
{
    echo "For the secret key, please enter a number sequence separated by spaces, example: 1, 2, 5, 10, 20, 50\n";
    $line = readline("Enter your list of number: ");
    readline_add_history($line);
    $privateKey = explode(",", $line);
    $tmpValue = 0;
    var_dump($privateKey);
    foreach ($privateKey as $value) {
        trim($value);
        if (is_numeric($value) && $value > 0) {
            echo $tmpValue;
            if ($tmpValue < $value) {
                $tmpValue += $value;
                setEM($tmpValue);
            } else {
                echo "The sequence of numbers does not correspond to the rules of the supercrossing sequence\n";
                createSecretKey();
            }
        } else
            echo "Value is not a number\n";
        createSecretKey();
    }
}

function setEM($tmpValue)
{
    echo "Please enter two prime number between them E and M\n";
    echo "E must be greater than 1 and smaller than M\n";
    $line = readline("Enter your first number E: ");
    $em = array();

    trim($line);

    if (is_numeric((Integer)$line) && $line > 1)
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