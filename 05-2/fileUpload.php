<?php

function fileUpload($section,$field,$location)
{
    $name =$_FILES[$section]['name'][$field];
    $extension = substr($name, strpos($name, '.') + 1);
    $temp = $_FILES[$section]['tmp_name'][$field];
    if (isset($name)) {
        if (!empty($name)) {
            if ($extension == 'jpg' || $extension == "jpeg" ) {
                $location .= '/';
                if (move_uploaded_file($temp, $location . $name)) {
                } else {
                    echo "Error in upload";
                }
            } else {
                echo "please upload only  jpeg file";
            }
        } else {
            echo "please choose a file";
        }
    }
}
