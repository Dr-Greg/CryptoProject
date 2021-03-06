<?php

function my_modulo($int, $n)
{
    $mod = $int;


    if ($mod >= 0) {
        while ($mod >= $n)
            $mod -= $n;
    } else {
        while ($mod < -$n)
            $mod += $n;
        $mod += $n;
    }
    return ($mod);
}

function my_inv_modulo($a, $n)
{
    for ($i = 2; $i <= $n; $i++) {
        if (my_modulo(($i * $a), $n) == 1)
            return ($i);
    }
}

function PGCD($a, $b)
{
    $r = 1;
    while ($r != 0) {
        $r = my_modulo($a, $b);
        $a2 = $a;
        $a = $b;
        $b2 = $b;
        $b = $r;
    }
    return ($a2 / $b2);
}

