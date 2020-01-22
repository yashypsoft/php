<?php

function smallNumInArray($values)
{
    $min = $values[0];
    for ($i = 0; $i < sizeof($values); $i++) {
        if ($min > $values[$i]) {
            $min = $values[$i];
        }
    }
    return $min;
}

$values = [25, 1, 29, 30, 65, 9];
echo smallNumInArray($values);
