<?php

function reverseNumber($number)
{
    $reverseNum = 0;
    $length = strlen($number);
    while (!$number == 0) {
        $singleNum = $number % 10;
        $reverseNum += $singleNum * pow(10, $length - 1);
        $number = $number / 10;
        $length--;
    }
    return $reverseNum;
}

echo reverseNumber(56789);
