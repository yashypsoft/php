<?php

    $number = 5;

    switch($number){
        case 1:
            echo 'one <br>';
            break;
        case 2:
            echo 'two <br>';
            break;
        case 3:
            echo 'three <br>';
            break;
        case 4:
            echo 'four <br>';
            break;
        case 5:
            echo 'five <br>';
            break;
        default:
            echo "number not found <br>";
            break;
    }



    $favcolor = "red";

    switch ($favcolor) {
    case "red":
        echo "Your favorite color is red!";
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    case "green":
        echo "Your favorite color is green!";
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}


?>