<?php

$xml = simplexml_load_file('example.xml');
// print_r($xml);


// echo $xml->teacher[1]->name . ' ' . $xml->teacher[2]->age;

foreach($xml->teacher as $teacher){
    echo $teacher->name . ' is '. $teacher->age .'Years old <br>' ;
    foreach($teacher->lecture as $lecture){
        echo $lecture->subject ." on " . $lecture->Lecturetime ."<br>";
    }
}
