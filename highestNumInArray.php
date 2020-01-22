<?php

function highestNumInArray($values)
{
    $max = $values[0];
    for ($i = 0; $i < sizeof($values); $i++) {
        if ($max < $values[$i]) {
            $max = $values[$i];
        }
    }
    return $max;
}

$values = [25, 1, 29, 30, 65, 9];
echo highestNumInArray($values);
