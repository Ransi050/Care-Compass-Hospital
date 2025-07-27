<?php

//$con = mysqli_connect("127.0.0.1", "u315535495_labetalk", "4N~g3AP~sih8", "u315535495_labetalk", 3306);
$conn = mysqli_connect("localhost","root","", "care_compass_hospital");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>