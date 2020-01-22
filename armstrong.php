<?php

function armstrong($num)
{
    $temp = $num;
    $sum = 0;

    while (!$temp == 0) {
        $singleNum = $temp % 10;
        $sum += pow($singleNum, 3);
        $temp = $temp / 10;
    }
    if ($num == $sum) {
        return 'Number is armstrong';
    } else {
        return 'Number is not  a armstrong';
    }
}

echo armstrong(370);
