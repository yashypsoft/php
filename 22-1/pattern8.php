<?php
function displayPattern($row, $col)
{
    for ($i = 0; $i <= $row; $i++) {
        for ($j = 0; $j <= $col; $j++) {
            if ($j == 0 || $j == $col || $i == $j || $i == $col - $j) {
                echo "*";
            } else {
                echo "&nbsp&nbsp";
            }
        }
        echo '<br>';
    }
}

displayPattern(30,30);