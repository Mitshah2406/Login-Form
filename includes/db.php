<?php

$servername ="localhost";
$username = "root";
$password = "";
$database ="loginsys";

$conn = mysqli_connect($servername,$username,$password,$database);

if($conn){
// echo "connection done";
}
else{
    echo "Not Connected";
}
?>