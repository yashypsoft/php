<?php

function hitCounter()
{
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    $ipFile = file('ip.txt');
    foreach ($ipFile as $ip) {
        $ipSingle = trim($ip);
        if ($ipSingle == $ipAddress) {
            $found = true;
        } else {
            $found = false;
        }
    }
    if ($found == false) {
        $filename = 'counter.txt';
        $handle = fopen($filename, 'r');
        $counter = fread($handle, filesize($filename));
        fclose($handle);

        $counterInc = $counter + 1;
        $handle = fopen($filename, 'w');
        fwrite($handle, $counterInc);
        fclose($handle);
    }
}
