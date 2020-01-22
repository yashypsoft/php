<?php
function bubbleSort($array)
{
    for ($i = 0; $i < sizeof($array); $i++) {
        for ($j = 0; $j < sizeof($array) - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    return $array;
}

$array = [25, 6, 364, 1, 87, 28];

$newArray = bubbleSort($array);

foreach($newArray as $item){
    echo "Sorted item $item";
    echo "<br>";
}