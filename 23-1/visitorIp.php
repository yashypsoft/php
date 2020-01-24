<?php
require 'findIp.php';

foreach($blockedIp as $ip){
    if($client_ip==$ip){
        die();
    }
}
echo '<h2>Welcome </h2>';