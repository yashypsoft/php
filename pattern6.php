<?php

function displayPattern($row, $col)
{
    for ($i = 1; $i <= $row; $i++) {
        for ($j = 1; $j <= $col; $j++) {

            if ($j == 1  || $j == $col || $i == 1 || $i == $row) {
                echo  '*';
            } else {
                echo '&nbsp&nbsp';
            }
        }
        echo  '<br>';
    }
}

displayPattern(15, 25);
