<?php
$hn = 'localhost'; 
$un = 'fastburger_admin'; 
$pw = 'YSAPNi_t7AKe9WV('; 
$db = 'fast_burger'; 

$conn = mysqli_connect($hn, $un, $pw, $db);
if (!$conn){
    die('Connection Failed: ' . mysqli_connect_error());
}
else {
    echo('connection is successful'); 
}
// pause the video and copy this code on the the dbConfig file within the config folder