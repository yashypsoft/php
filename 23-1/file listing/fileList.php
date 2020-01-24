<?php


$directory = 'files';
if ($handler = opendir($directory . '/')) {
    echo "you are in to <strong>$directory </strong> <br>";
    while ($file = readdir($handler)) {
        if ($file != '.' && $file != '..')
            echo '<a href="files/' . $file . '">' . $file . '<br>';
    }
}
