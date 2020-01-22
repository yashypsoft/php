<?php
/*
Pattern 3
*
* *
* * *
* * * *
* * * * *
* * * * * *
* * * * * * *
* * * * * * * *
* * * * * * * * *
*/
function displayPattern($line)
{
    for ($i = 0; $i < $line; $i++) {
        for ($j = 0; $j <= $i; $j++) {
            echo '* ';
        }
        echo '<br>';
    }
}
displayPattern(9);
