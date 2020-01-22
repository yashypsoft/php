<?php
function stringConcate($string1, $string2)
{
    
    $string3 = "";
    for ($i = 0; $i < max(strlen($string1), strlen($string2)); $i++) {
        $string3 .= $string1[$i] . $string2[$i];
    }
    echo $string3;
}

stringConcate("JOHN", "SMITH");
