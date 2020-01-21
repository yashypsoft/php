<?php

$sentance = "Hello Everyone.";
$lengthOfSentence = strlen($sentance);

echo $lengthOfSentence;
echo '<br>';
for($i=0;$i<$lengthOfSentence;$i++)
{
    echo nl2br("Something is repeat\n");
}

//lower and upper string

$lower = strtolower($sentance);
$upper = strtoupper($sentance);

echo $lower .'<Br>'. $upper .'<br>';

//
$offset = 0;
$paragraph = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores, in.';
$find  = "l";
$size = strlen($find);

while($position = strpos($paragraph,$find,$offset))
{
    echo "string found at $position <br> ";
    $offset = $position +$size;


}


//string replace

$string = "Welcome to Cybercom creation";
$find = ['a','e','i'];
$replace = ['A','E','I'];
$newString = str_replace($find,$replace,$string,$i);

echo "New string = <strong>  $newString  </strong>and how many position replaced $i";









?>