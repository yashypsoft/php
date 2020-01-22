<?php


$site = "http://www.com";
@fopen($site,'r') or die("Unable to connect ");

$num1 = 5;
$num2 = 10;

if($num1 == $num2){
    die("Num1 and num 2 are equal");
}
else{
    die("Num1 and num 2 are not equal");
}

echo 'Hello ';
exit('error page has ended');
echo ' world';

?>