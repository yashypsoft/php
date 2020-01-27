<?php

$xml = simplexml_load_file('https://www.w3schools.com/xml/cd_catalog.xml');
//  print_r($xml);


foreach ($xml->CD as $CD) {
    echo $CD->TITLE . "<br>";
}
