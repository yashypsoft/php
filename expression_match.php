<?php

$string = "WelcometoCybercomcreation";

if(preg_match('/to/',$string)){
    echo "Match found<br>";
}else{
    echo "No match found<br>";
}


function hasSpace($text){
    if(preg_match('/ /',$text)){
        return true;
    }else{
         return false;
    }
}

if(hasSpace($string)){
    echo "Has at least one space<br>";  
}
else{
    echo "Has no space<br>";
}

$email = 'yashypsoft@gmail.com';

if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/",$email)){
    echo "your email id is valid<br>";
}else{
    echo 'your email id is invalid<br>';
}




?>