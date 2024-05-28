<?php
$hn = 'localhost'; 
$un = 'fastburger_admin'; 
$pw = '.IQWUWrme.TrTnSI'; 
// $db = 'fastburgers'; 
$db = 'fast_burger'; 
$un = 'root'; 
$pw = ''; 
$conn = mysqli_connect($hn, $un, $pw, $db);
if (!$conn){
    die('Connection Failed: ' . mysqli_connect_error());
}
// add the else statement to view if the connection is successful
// else {
//     echo('connection is successful'); 
// }
