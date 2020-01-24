<?php

$fileName = "filerename.txt";
$newName = rand(1000, 5000) . ".txt";
if (@rename($fileName, $newName)) {
    echo "file <strong> $fileName </strong> has been Renamed";
} else {
    echo "Error in Rename";
}
