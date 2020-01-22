<?php

//indexed array
$cricketer = array('sachin', 'virat', 'dhoni');
// $cricketer = ['sachin','virat','dhoni']; //or

echo $cricketer[0];
print_r($cricketer);
echo '<br>';

//associative array
$cricketer = array('sachin' => 99, 'virat' => 56, 'dhoni' => 55);
var_dump($cricketer);
echo '<br>';
echo '<br>';

echo $cricketer['sachin'];
echo '<br>';

//for each to access array elements
foreach ($cricketer as $player => $runs) {
    echo $player . ' scores  ' . $runs;
    echo '<br>';
}

//multidimention array
$posts = array(
    'user1' => array(256, 14, 3),
    'user2' => array(256, 14, 3),
    'user3' => array(256, 14, 3)
);

foreach ($posts as $user => $insight) {
    echo '<br>';
    echo $user . ' Posts getting likes = ' . $insight[0]  . ' comment = ' . $insight[1] . ' Saved = ' . $insight[2];
}


//soring of array 
$numbers = [36, 5, 29, 399, 12, 7, 36];
sort($numbers);
foreach ($numbers as $num) {
    echo $num;
    echo '<br>';
}
