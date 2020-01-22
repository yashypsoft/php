<?php
function findLCM($num1, $num2)
{
    $store1 = [];
    $store2 = [];

    for ($i = 1; $i <= 10; $i++) {
        $store1[$i - 1] = $num1 * $i;
        $store2[$i - 1] = $num2 * $i;
    }

    for ($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < 10; $j++) {
            if ($store1[$i] == $store2[$j]) {
                return $store1[$i];
            }
        }
    }
}

$val1 = 12;
$val2 = 30;
echo " LCM of $val1 and $val2 =" . findLCM($val1, $val2);
