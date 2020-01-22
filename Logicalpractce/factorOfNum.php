<?php

function factorOfNum($num)
{
    $factor = [];
    $j = 0;
    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i) {
        } else {
            $factor[$j] = $i;
            $j++;
        }
    }
    return $factor;
}

$val  = 25;
foreach (factorOfNum($val) as $fact) {
    echo "factor of $val =" . $fact;
    echo '<br>';
}
