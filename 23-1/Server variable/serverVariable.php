<?php

echo "Server host =" . $_SERVER['SERVER_PORT'];
echo "<br>";
echo "Server Name =" . $_SERVER['SERVER_NAME'];
echo "<br>";
echo "Server SELF =" . $_SERVER['PHP_SELF'];
echo "<br>";
echo "Script Name =" . $_SERVER['SCRIPT_NAME'];
echo "<br>";
echo "Server signature =" . $_SERVER['SERVER_SIGNATURE'];
echo "<br>";
echo "request url =" . $_SERVER['REQUEST_URI'];
echo "<br>";
echo "Script file name =" . $_SERVER['SCRIPT_FILENAME'];
echo "<br>";
echo "Remote address  =" . $_SERVER['REMOTE_ADDR'];
echo "<br>";
echo "HTTP USER AGENT =" . $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo "HTTP HOST =" . $_SERVER['HTTP_HOST'];


$indicesServer = array('PHP_SELF',
'argv',
'argc',
'GATEWAY_INTERFACE',
'SERVER_ADDR',
'SERVER_NAME',
'SERVER_SOFTWARE',
'SERVER_PROTOCOL',
'REQUEST_METHOD',
'REQUEST_TIME',
'REQUEST_TIME_FLOAT',
'QUERY_STRING',
'DOCUMENT_ROOT',
'HTTP_ACCEPT',
'HTTP_ACCEPT_CHARSET',
'HTTP_ACCEPT_ENCODING',
'HTTP_ACCEPT_LANGUAGE',
'HTTP_CONNECTION',
'HTTP_HOST',
'HTTP_REFERER',
'HTTP_USER_AGENT',
'HTTPS',
'REMOTE_ADDR',
'REMOTE_HOST',
'REMOTE_PORT',
'REMOTE_USER',
'REDIRECT_REMOTE_USER',
'SCRIPT_FILENAME',
'SERVER_ADMIN',
'SERVER_PORT',
'SERVER_SIGNATURE',
'PATH_TRANSLATED',
'SCRIPT_NAME',
'REQUEST_URI',
'PHP_AUTH_DIGEST',
'PHP_AUTH_USER',
'PHP_AUTH_PW',
'AUTH_TYPE',
'PATH_INFO',
'ORIG_PATH_INFO') ;

echo '<table cellpadding="10">' ;
foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
    }
    else {
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
    }
}
echo '</table>' ;