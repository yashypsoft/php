<?php
function factorial($num)
{
    if ($num == 1 || $num == 0) {
        return 1;
    } else {
        for ($i = 2; $i <= $num; $i++) {
            return $num * factorial($num - 1);
        }
    }
}

echo factorial(4);
