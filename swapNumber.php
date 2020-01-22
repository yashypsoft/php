<?php

function swapNumber($num1, $num2)
{
    //with third variable
    // $temp = $num1;
    // $num1 = $num2;
    // $num2 = $temp;

    //without third variable
    $num2 = $num1 + $num2;
    $num1 = $num2 - $num1;
    $num2 = $num2 - $num1;

    echo "Number 1 = $num1 and number 2 = $num2 ";
}

swapNumber(25, 10);
