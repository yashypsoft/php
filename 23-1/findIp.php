<?php
$client_ip = '';
$blockedIp = ['127.0.0.1', '192.1.11.1'];
echo $http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
echo $http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
echo $remoteAdd = $_SERVER['REMOTE_ADDR'];

if (!empty($http_client_ip)) {
    $client_ip = $http_client_ip;
} else if (!empty($http_x_forwarded_for)) {
    $client_ip = $http_x_forwarded_for;
} else {
    $client_ip = $remoteAdd;
}
// $client_ip = $_SERVER['REMOTE_ADDR'];

echo $client_ip;
