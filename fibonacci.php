<?php

function fibonacci($num)
{
    $first = 0;
    $second = 1;
    if ($num) {
        echo $first . ' ';
    }
    if ($num - 1) {
        echo $second . ' ';
    }
    for ($i = 1; $i <= $num - 2; $i++) {
        $sum = $first + $second;
        echo $sum . ' ';
        $first = $second;
        $second = $sum;
    }
}


fibonacci(10);
