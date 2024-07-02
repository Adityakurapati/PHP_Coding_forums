<?php
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "forems";

$conn = mysqli_connect($server,$user,$pass,$dbname);
if(!$conn){
    die("Not connected");
}else{
    // echo "Connecting To Database";
}
?>