<?php

function highestCommonFactor($num1, $num2)
{

    $factor1 = [];
    $factor2 = [];
    $commonFactor = [];
    $j = 0;
    $k = 0;
    $x = 0;
    for ($i = 1; $i <= $num1; $i++) {
        if ($num1 % $i) {
        } else {
            $factor1[$j] = $i;
            $j++;
        }
    }
    for ($i = 1; $i <= $num2; $i++) {
        if ($num2 % $i) {
        } else {
            $factor2[$x] = $i;
            $x++;
        }
    }

    for ($i = 0; $i < sizeof($factor1); $i++) {
        for ($j = 0; $j < sizeof($factor2); $j++) {
            if ($factor1[$i] === $factor2[$j]) {
                $commonFactor[$k] = $factor1[$i];
                $k++;
            }
        }
    }
    return $commonFactor[sizeof($commonFactor) - 1];
}

$val1 = 15;
$val2 = 10;
echo  "Highest Common factor for $val1 and $val2 = " . highestCommonFactor($val1, $val2);
