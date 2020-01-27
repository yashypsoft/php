<?php

$to = "yashypsoft@gmail.com";
$body = "hello this is body of mail";
$header = "From : vigo12qp@gmail.com";
$subject = "subject of mail";
if(mail($to,$subject,$body,$header)){
    echo "mail send to $to Successfully";
}
else{
    echo "mail sending failed";
}