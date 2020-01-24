<?php

$file = "file.txt";
if (file_exists($file)) {
    echo "file alread exists";
} else {
    $handle = fopen($file, "w");
    fwrite($handle, "Nothing");
    fclose($handle);
    echo "file created";
}
