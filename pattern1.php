<?php
/*
Pattern 1
* * * * * * * * * * * * * * * * *
* * * * * * * * * * * * * * *
* * * * * * * * * * * * *
* * * * * * * * * * *
* * * * * * * * *
* * * * * * *
* * * * *
* * *
*

*/



function displayPattern($line)
{
    for ($i = $line + 8; $i >= 0; $i -= 2) {
        for ($j = 0; $j < $i; $j++) {
            echo '* ';
        }
        echo ' <br>';
    }
}
displayPattern(9);
