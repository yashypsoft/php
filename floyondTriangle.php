<?php

function displayPattern($line)
{
    $k=1;
    for ($i = 1; $i <= $line; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo ($k ) .' ';
            $k++;
        }
        echo '<br>';
    }
}
displayPattern(9);
