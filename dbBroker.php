<?php

$host = "localhost";
$user = "root";
$db = "salon";
$password = "";

$conn = new mysqli($host, $user, $password, $db);

if($conn->connect_errno){
    exit("Neuspesna konekcija: desila se greska> " .$conn->connect_error.", err kod>".$conn->connect_errno);
}


?>