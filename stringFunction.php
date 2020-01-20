<?php

$string = "Welcome to Cybercom creation.";

//str_word_count that count word
$wordCount1 = str_word_count($string,0);
$wordCount2 = str_word_count($string,1);
$wordCount3 = str_word_count($string,2);
$wordCount4 = str_word_count($string,1,'.');

echo $wordCount1.'<br>';
print_r ($wordCount4) ;

//suffle string
$string_suffled = str_shuffle($string);
echo '<br>'.$string_suffled .'<br>';


//substr return a sub string
$half = substr($string,0,strlen($string)/2);
echo $half.'<br>';

//reverse string 
$reverse = strrev($string);
echo $reverse.'<br>';


//find simmilarity between two string.
$string1 = "Welcome to Cybercom creation.";
$string2 = "Welcome to GEC Bhavnagar.";
similar_text($string1,$string2,$result);
echo 'Simmilarity  between '. $result.'<br>';


//length of string
$length = strlen($string);
echo $length .'<br>';


//add slash in 
$text = 'This is a image tag <img src="image.jpg">';
$stringSlash = htmlentities(addslashes($text));

//Strip Slash
echo stripcslashes($stringSlash).'<br>';

//find position of string
$position = strpos($string,'Cybercom');
echo $position.'<br>';

//replace string
$replaceString =str_replace('Cybercom','Hey',$string);
echo $replaceString.'<br>';

//convert first alphabet of every word into uppercase
$firstCapital = ucwords($string);
echo $firstCapital.'<br>';

//Conver to uppercase
$upper = strtoupper($string);
echo $upper.'<br>';

//convert to lower
$lower = strtolower($string);
echo $lower.'<br>';

//Repeat string
$repeatString = str_repeat($string,5);
echo $repeatString.'<br>';

//compare string
echo strcmp("HELLO","HELLO");


?>