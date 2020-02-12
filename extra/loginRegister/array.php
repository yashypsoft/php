<?php
require 'config.php';
connection();

$number  = ['a','b', 'c', 'd', 'e', 'f'];

$i = 0;

$arry = [];
for ($cnt = 0; $cnt < count($number) - 2; $cnt++) {
    $arry[$number[$cnt]] = [$number[$cnt + 1], $number[$cnt + 2]];
    $cnt += 2;
    $i++;
}


echo "<pre>";
print_r($arry);
echo "</pre>";
