<?php
/*
Pattern 2
1 2 3 4 5 6 7 8 9
1 2 3 4 5 6 7 8
1 2 3 4 5 6 7
1 2 3 4 5 6
1 2 3 4 5
1 2 3 4
1 2 3
1 2
1


*/


function displayPattern($line)
{
    for ($i = $line; $i >= 0; $i--) {
        for ($j = 0; $j < $i; $j++) {
            echo  $j+1 ." ";
        }
        echo '<br>';
    }
}
displayPattern(9);
