<?php
function displayPattern($row, $col)
{
    $k = 1;
    for ($i = 1; $i <= $row; $i++) {
        for ($j = 1; $j <= $col; $j++) {
            echo $k . ' ';
            $k++;
        }
        echo '<br>';
    }
}

displayPattern(5, 4);
