<?php

$fileName = "filedelete.txt";
if (@unlink($fileName)) {
    echo "file <strong> $fileName </strong> has been deleted";
}else{
    echo "file can not deleted";
}
