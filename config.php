<?php
// Connect to database
$server = "localhost";
$user = "thinhhoang"; 
$pass = "221020";
$dbname = "parking";

$conn = mysqli_connect($server,$user,$pass,$dbname);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


?>