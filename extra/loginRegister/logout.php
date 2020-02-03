<?php
require('config.php');
session_start();
connection();
unset($_SESSION['loginflag']);
$_SESSION['lgo'] = Date("Y:m:d h:i:s");
$lgi = $_SESSION['lfi'];
$lgo = $_SESSION['lgo'];
$id = $_SESSION['id'];
$sessionLog =  sessionLogArray($lgi,$lgo,$id);
insertData('usersessionlog',$sessionLog);
session_destroy();
header("Location: index.php");
