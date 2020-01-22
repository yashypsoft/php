<?php

//simple function
function displayName(){
    echo 'Yash Prajapati <br>';
}
displayName();

//function with arg
function calculateSum($num1,$num2){
    echo "Sum = " . ($num1 + $num2) .'<br>';
}

calculateSum(2,4);
calculateSum(5,10);

//function return value
function add($num1,$num2){
    $result = $num1 +$num2;
    return $result;
}
function divide($num1,$num2){
    $result = $num1 / $num2;
    return $result;
}

echo divide(add(100,10),add(25,5));

//function function with optional parameter
function customFont($font,$size=3){
    echo "<p style=\"font-family: $font; font-size: {$size}em;\">Hello, world!</p>";
}
customFont('Arial',5);
customFont('Courier');

//global variable and function

$name = 'John Doe';

function johnDetails(){
    global $name;
    echo "My name is  $name";
}
johnDetails();



?>