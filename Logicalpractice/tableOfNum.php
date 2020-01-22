<?php

function tableOfNum($num)
{
    for ($i = 1; $i <= 10; $i++) {
        echo "$num * $i =" . $num * $i;
        echo '<br>';
    }
}

tableOfNum(5);
