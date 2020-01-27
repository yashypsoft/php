<?php

function hitCounter(){
    $filename = 'counter.txt';
    $handle = fopen($filename,'r');
    $counter = fread($handle,filesize($filename));
    fclose($handle);

    $counterInc = $counter + 1;
    $handle = fopen($filename,'w');
    fwrite($handle,$counterInc);
    fclose($handle);
}