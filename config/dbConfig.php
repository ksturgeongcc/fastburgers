<?php
$hn = 'localhost'; 
$un = 'fastburger_admin'; 
$pw = '.IQWUWrme.TrTnSI'; 
$db = 'fastburgers'; 

$conn = mysqli_connect($hn, $un, $pw, $db);
if (!$conn){
    die('Connection Failed: ' . mysqli_connect_error());
}
else {
    echo('connection is successful'); 
}
