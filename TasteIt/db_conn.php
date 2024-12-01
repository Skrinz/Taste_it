<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "agrivet_db";

$conn = new mysqli($server, $user, $password, $database);
if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}

?>