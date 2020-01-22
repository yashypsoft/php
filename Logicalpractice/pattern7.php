<?php

function displayPattern($line)
{
    $zero = '0';
    for ($i = 0; $i <= $line + 8; $i += 2) {
        for ($j = 0; $j <= $i; $j++) {
            echo '* ';
        }
        echo $zero;
        $zero = "$zero 0";
        echo ' <br>';
    }
}

displayPattern(9);
